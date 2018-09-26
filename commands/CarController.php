<?php

namespace app\commands;

use Yii;
use app\models\CarBody;
use app\models\CarColor;
use app\models\CarFuel;
use app\models\CarKind;
use app\models\CarOperation;
use app\models\CarPurpose;
use app\models\CarService;
use app\models\CarInfo;
use yii\console\Controller;
use yii\helpers\Console;

class CarController extends Controller
{
    /**
     * Fills table car_info from local files
     * @param $year
     * @throws \yii\db\Exception
     */
    public function actionExportLocal($year = null)
    {
        $checkRequest = CarInfo::find();
        if ($year) {
            $checkRequest->where("d_reg BETWEEN '$year-01-01' AND '$year-12-31'");
        }
        $checkCount = (int)$checkRequest->count('id');
        if ($checkCount > 0) {
            $this->stdout("Data was already exported." . PHP_EOL, Console::FG_RED);
            exit;
        }

        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'tz_csv';
        if (!file_exists($path)) {
            $this->stdout("Folder by path '$path' is not exist." . PHP_EOL, Console::FG_RED);
            exit;
        }

        $files = array_diff(scandir($path), ['.', '..']);
        if (empty($files)) {
            $this->stdout("There are not files for updating." . PHP_EOL, Console::FG_RED);
            exit;
        }

        $total = 0;
        foreach ($files as $fileName) {
            if ($year && stripos($fileName, $year) === false) {
                continue;
            }
            $fileCount = 0;
            $filePath = $path . DIRECTORY_SEPARATOR . $fileName;
            $file = fopen($filePath, 'r');
            $attributes = fgetcsv($file, 0, ';');
            $attributesKeys = array_flip($attributes);

            $batchAttributes = $attributes;
            unset($batchAttributes[$attributesKeys['oper_name']], $batchAttributes[$attributesKeys['dep']]);

            $data = [];
            while (($row = fgetcsv($file, 0, ';')) !== false) {
                if ($row && is_array($row)) {
                    ++$total;
                    ++$fileCount;

                    $values = array_combine($attributes, $row);
                    $this->saveOperation($values['oper_code'], $values['oper_name']);
                    $this->saveService($values['dep_code'], $values['dep']);

                    unset($row[$attributesKeys['oper_name']], $row[$attributesKeys['dep']]);
                    $row[$attributesKeys['brand']] = trim(
                        str_replace($row[$attributesKeys['model']], '', $row[$attributesKeys['brand']])
                    );
                    $row[$attributesKeys['color']] = $this->getColorId($row[$attributesKeys['color']]);
                    $row[$attributesKeys['kind']] = $this->getKindId($row[$attributesKeys['kind']]);
                    $row[$attributesKeys['body']] = $this->getBodyId($row[$attributesKeys['body']]);
                    $row[$attributesKeys['purpose']] = $this->getPurposeId($row[$attributesKeys['purpose']]);
                    $row[$attributesKeys['fuel']] = $this->getFuelId($row[$attributesKeys['fuel']]);
                    $row[$attributesKeys['n_reg_new']] = $this->getRegNumber($row[$attributesKeys['n_reg_new']]);
                    $data[] = $row;
                    if (count($data) == 1000) {
                        $sql = Yii::$app->db->createCommand()
                            ->batchInsert('{{%car_info%}}', $batchAttributes, $data)->getRawSql();
                        $sql = preg_replace('/^INSERT/', 'INSERT IGNORE', $sql);
                        Yii::$app->db->createCommand($sql)->execute();
                        $data = [];
                    }
                }
            }

            if ($data) {
                $sql = Yii::$app->db->createCommand()
                    ->batchInsert('{{%car_info%}}', $batchAttributes, $data)->getRawSql();
                $sql = preg_replace('/^INSERT/', 'INSERT IGNORE', $sql);
                Yii::$app->db->createCommand($sql)->execute();
                $data = null;
            }

            fclose($file);
            $this->stdout("Inserted $fileCount records from file $fileName." . PHP_EOL, Console::FG_GREEN);
        }

        $this->stdout("Total inserted $total records." . PHP_EOL, Console::FG_GREEN);
    }

    /**
     * @param $code
     * @param $name
     */
    private function saveOperation($code, $name)
    {
        $operation = CarOperation::find()->select('id')->where(['oper_code' => $code])->scalar();
        if (!$operation) {
            $operation = new CarOperation([
                'oper_code' => $code,
                'oper_name' => mb_strtolower(trim(str_replace("$code - ", '', $name))),
            ]);
            $operation->save(false);
        }
    }

    /**
     * @param $code
     * @param $name
     */
    private function saveService($code, $name)
    {
        $service = CarService::find()->select('id')->where(['dep_code' => $code])->scalar();
        if (!$service) {
            $service = new CarService([
                'dep_code' => $code,
                'dep' => trim(str_replace($code, '', $name)),
            ]);
            $service->save(false);
        }
    }

    /**
     * @param $value
     * @return int|null
     */
    private function getColorId($value)
    {
        $id = (int)CarColor::find()->select('id')->where(['color' => mb_strtolower($value)])->scalar();
        if (!$id) {
            $color = new CarColor(['color' => mb_strtolower($value)]);
            $color->save(false);
            $id = $color ? $color->id : null;
        }
        return $id;
    }

    /**
     * @param $value
     * @return int|null
     */
    private function getKindId($value)
    {
        $id = (int)CarKind::find()->select('id')->where(['kind' => mb_strtolower($value)])->scalar();
        if (!$id) {
            $kind = new CarKind(['kind' => mb_strtolower($value)]);
            $kind->save(false);
            $id = $kind ? $kind->id : null;
        }
        return $id;
    }

    /**
     * @param $value
     * @return int|null
     */
    private function getBodyId($value)
    {
        $id = (int)CarBody::find()->select('id')->where(['body' => mb_strtolower($value)])->scalar();
        if (!$id) {
            $body = new CarBody(['body' => mb_strtolower($value)]);
            $body->save(false);
            $id = $body ? $body->id : null;
        }
        return $id;
    }

    /**
     * @param $value
     * @return int|null
     */
    private function getPurposeId($value)
    {
        $id = (int)CarPurpose::find()->select('id')->where(['purpose' => mb_strtolower($value)])->scalar();
        if (!$id) {
            $purpose = new CarPurpose(['purpose' => mb_strtolower($value)]);
            $purpose->save(false);
            $id = $purpose ? $purpose->id : null;
        }
        return $id;
    }

    /**
     * @param $value
     * @return int|null
     */
    private function getFuelId($value)
    {
        if (mb_strtolower($value) == 'null') {
            return null;
        }

        $id = (int)CarFuel::find()->select('id')->where(['fuel' => mb_strtolower($value)])->scalar();
        if (!$id) {
            $fuel = new CarFuel(['fuel' => mb_strtolower($value)]);
            $fuel->save(false);
            $id = $fuel ? $fuel->id : null;
        }
        return $id;
    }

    /**
     * @param string $value
     * @return null|string
     */
    private function getRegNumber($value)
    {
        if (mb_strtolower($value) == 'null') {
            return null;
        }
        return $value;
    }
}
