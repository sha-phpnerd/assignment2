<?php

namespace ShaPhpnerd\Assginment2;

class App
{
    private function __construct()
    {
    }

    public static function start(): void
    {
        begin:
        foreach (Actions::cases() as $key => $case) {
            printf("%d. %s\n", ++$key, $case->label());
        }
        $action = self::promptForInput('Please select an option', CliPromptTypes::OPTION);
        if (in_array($action, [Actions::VIEW_EXPENSES, Actions::VIEW_INCOMES, Actions::VIEW_SAVINGS, Actions::VIEW_CATEGORIES])) {
            printf("==== ". $action->label() ." ====\n");
            $value = DBHandler::read($action);
            if(is_array($value)){
                foreach($value as $key=>$value){
                    printf("\t" .($key + 1) .". ".$value." \n");
                }
            }else{
                printf("\t $value \n");
            }
            printf("\n======================\n");
        } elseif (in_array($action, [Actions::ADD_EXPENSE, Actions::ADD_INCOME])) {
            $value = self::promptForInput("Enter the value for {$action->value}", CliPromptTypes::VALUE);
            DBHandler::write($action, $value);
        }

        if($action != Actions::EXIT){
            goto begin;
        }

    }

    private static function promptForInput(string $message, CliPromptTypes $promptType): float | Actions
    {
        label:
        $input = readline(sprintf("\n%s: ", $message));

        if ($input && $promptType == CliPromptTypes::OPTION && Actions::tryFrom($input)) {
            return Actions::from((int)$input);
        }
        if ($promptType == CliPromptTypes::VALUE && is_numeric($input)) {
            return (float) $input;
        }
        goto label;
    }
}
