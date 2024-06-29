<?php

namespace ShaPhpnerd\Assginment2;

class DBHandler
{
    public static function write(Actions $action, float $value)
    {
        try {
            $path = __DIR__ . '/../db.json';

            $contents = file_get_contents($path);

            $jsonArray = json_decode($contents, true);

            if ($action == Actions::ADD_INCOME) {
                $jsonArray['INCOMES'][] = $value;
            }
            if ($action == Actions::ADD_EXPENSE) {
                $jsonArray['EXPENSES'][] = $value;
            }

            $jsonStr = json_encode($jsonArray);
            file_put_contents($path, $jsonStr);
        } catch (\Exception $exception) {
            printf($exception->getMessage());
            throw new \Exception('Internal error', 500);
        }
    }

    public static function read(Actions $action)
    {
        try {

            $path = __DIR__ . '/../db.json';

            $contents = file_get_contents($path);
            $jsonArray = json_decode($contents, true);



            if ($action == Actions::VIEW_EXPENSES) {
                return $jsonArray['EXPENSES'];
            }
            if ($action == Actions::VIEW_INCOMES) {
                return $jsonArray['INCOMES'];
            }
            if ($action == Actions::VIEW_CATEGORIES) {
                return array_keys($jsonArray);
            }
            if ($action == Actions::VIEW_SAVINGS) {
                return array_sum($jsonArray['INCOMES']) - array_sum($jsonArray['EXPENSES']);
            }
        } catch (\Exception $exception) {
            printf($exception->getMessage());
            throw new \Exception('Internal error', 500);
        }
    }
}
