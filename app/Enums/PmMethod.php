<?php 

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
 
enum PmMethod: string implements HasLabel, HasColor, HasIcon
{
    case KHQR = 'khqr';
    case CREDIT_CARD = 'credit_card';
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::KHQR => 'KHQR',
            self::CREDIT_CARD => 'Credit Card',
        };
    }
    public function getIcon(): string|null
    {
        return match ($this) {
            self::KHQR => 'heroicon-o-qr-code',
            self::CREDIT_CARD => 'heroicon-o-building-library',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::KHQR => 'info',
            self::CREDIT_CARD => 'warning',
        };
    }
}

