<?php

namespace Filament\Tables\Columns\Concerns;

use Closure;

trait HasSize
{
    protected string | Closure | null $size = null;

    public function size(string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }
}
