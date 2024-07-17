<?php 

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
 
enum Status: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
    public function getIcon(): string|null
    {
        return match ($this) {
            self::PENDING => 'heroicon-s-exclamation-circle',
            self::PROCESSING => 'heroicon-c-arrow-path',
            self::COMPLETED => 'heroicon-c-check-badge',
            self::CANCELLED => 'heroicon-m-x-circle',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::PENDING => 'info',
            self::PROCESSING => 'warning',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }
}

