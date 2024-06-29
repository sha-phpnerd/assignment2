<?php

namespace ShaPhpnerd\Assginment2;

enum Actions: int
{
    case ADD_INCOME = 1;
    case ADD_EXPENSE = 2;
    case VIEW_INCOMES = 3;
    case VIEW_EXPENSES = 4;
    case VIEW_SAVINGS = 5;
    case VIEW_CATEGORIES = 6;
    case EXIT = 7;

    public function label(){
        return ucwords(strtolower(implode(' ', explode('_', $this->name))));
    }
}
