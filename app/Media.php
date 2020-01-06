<?php

namespace Ddondola;

use Spatie\MediaLibrary\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    public function url() {
        return media_url($this);
    }
}
