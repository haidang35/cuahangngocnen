<?php 

namespace Modules\Debit\Enums;

enum DebitStatus: int {
    case PAID = 1;
    case PROCESSING = 2;
    case CANCEL = 3;
    case OUT_OF_DATE = 4;
}