<?php

namespace App\Enums;


enum Kategori: string
{
    case Processor = 'processor';
    case Monitor = 'monitor';
    case UPS = 'ups';
    case Mainboard = 'mainboard';
    case Memory = 'memory';
    case Storage = 'storage';
    case Printer = 'printer';
    case Keyboard = 'keyboard';
    case Mouse = 'mouse';
    case License = 'license';
    case Scanner = 'scanner';
    case Sparepart = 'sparepart';
    case CCTV = 'cctv';
    case Lainlain = 'lainlain';
}