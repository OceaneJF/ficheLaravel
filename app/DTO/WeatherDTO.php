<?php

namespace App\DTO;

class WeatherDTO
{
    public string $name;
    public string $main;
    public string $description;
    public string $icon;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? 'N/A';

        if (isset($data['weather'][0])) {
            $this->main = $data['weather'][0]['main'] ?? 'N/A';
            $this->description = $data['weather'][0]['description'] ?? 'N/A';
            $this->icon = $data['weather'][0]['icon'] ?? 'N/A';
        } else {
            $this->main = 'N/A';
            $this->description = 'N/A';
            $this->icon = 'N/A';
        }
    }
}
