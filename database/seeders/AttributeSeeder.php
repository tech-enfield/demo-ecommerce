<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        AttributeGroup::insert([
            ['name' => 'Body', 'slug' => 'body', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CPU', 'slug' => 'cpu', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Graphics', 'slug' => 'graphics', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Memory', 'slug' => 'memory', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Storage', 'slug' => 'storage', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Display', 'slug' => 'display', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'I/O', 'slug' => 'i-o', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Communication', 'slug' => 'communication', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Input Devices', 'slug' => 'input-devices', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Audio', 'slug' => 'audio', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Battery', 'slug' => 'battery', 'created_at' => $now, 'updated_at' => $now],

            // Accessories
            ['name' => 'Compatibility', 'slug' => 'compatibility', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Connectivity', 'slug' => 'connectivity', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Material', 'slug' => 'material', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Power', 'slug' => 'power', 'created_at' => $now, 'updated_at' => $now],
        ]);

        Attribute::insert([
            // Body
            ['attribute_group_id' => 1, 'name' => 'Dimension', 'slug' => 'dimension', 'created_at' => $now],
            ['attribute_group_id' => 1, 'name' => 'Weight', 'slug' => 'weight', 'created_at' => $now],
            ['attribute_group_id' => 1, 'name' => 'Color', 'slug' => 'color', 'created_at' => $now],

            // CPU
            ['attribute_group_id' => 2, 'name' => 'CPU Series', 'slug' => 'cpu-series', 'created_at' => $now],
            ['attribute_group_id' => 2, 'name' => 'Processor', 'slug' => 'processor', 'created_at' => $now],
            ['attribute_group_id' => 2, 'name' => 'Cores', 'slug' => 'cores', 'created_at' => $now],
            ['attribute_group_id' => 2, 'name' => 'Threads', 'slug' => 'threads', 'created_at' => $now],

            // Graphics
            ['attribute_group_id' => 3, 'name' => 'GPU', 'slug' => 'gpu', 'created_at' => $now],
            ['attribute_group_id' => 3, 'name' => 'Graphics Type', 'slug' => 'graphics-type', 'created_at' => $now],
            ['attribute_group_id' => 3, 'name' => 'VRAM', 'slug' => 'vram', 'created_at' => $now],
            ['attribute_group_id' => 3, 'name' => 'Boost Clock', 'slug' => 'boost-clock', 'created_at' => $now],

            // Memory
            ['attribute_group_id' => 4, 'name' => 'Installed RAM', 'slug' => 'installed-ram', 'created_at' => $now],
            ['attribute_group_id' => 4, 'name' => 'Memory Type', 'slug' => 'memory-type', 'created_at' => $now],
            ['attribute_group_id' => 4, 'name' => 'Frequency', 'slug' => 'frequency', 'created_at' => $now],
            ['attribute_group_id' => 4, 'name' => 'Channel', 'slug' => 'channel', 'created_at' => $now],
            ['attribute_group_id' => 4, 'name' => 'Maximum Capacity', 'slug' => 'maximum-capacity', 'created_at' => $now],

            // Storage
            ['attribute_group_id' => 5, 'name' => 'SSD', 'slug' => 'ssd', 'created_at' => $now],
            ['attribute_group_id' => 5, 'name' => 'HDD', 'slug' => 'hdd', 'created_at' => $now],
            ['attribute_group_id' => 5, 'name' => 'SSD Slots', 'slug' => 'ssd-slots', 'created_at' => $now],
            ['attribute_group_id' => 5, 'name' => 'Optical Drive', 'slug' => 'optical-drive', 'created_at' => $now],

            // Display
            ['attribute_group_id' => 6, 'name' => 'Size', 'slug' => 'size', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Panel Type', 'slug' => 'panel-type', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Touch Screen', 'slug' => 'touch-screen', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Finish', 'slug' => 'finish', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Resolution', 'slug' => 'resolution', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Refresh Rate', 'slug' => 'refresh-rate', 'created_at' => $now],
            ['attribute_group_id' => 6, 'name' => 'Brightness', 'slug' => 'brightness', 'created_at' => $now],

            // I/O
            ['attribute_group_id' => 7, 'name' => 'Ports', 'slug' => 'ports', 'created_at' => $now],
            ['attribute_group_id' => 7, 'name' => 'USB Type-C', 'slug' => 'usb-type-c', 'created_at' => $now],

            // Communication
            ['attribute_group_id' => 8, 'name' => 'Ethernet', 'slug' => 'ethernet', 'created_at' => $now],
            ['attribute_group_id' => 8, 'name' => 'WiFi', 'slug' => 'wifi', 'created_at' => $now],
            ['attribute_group_id' => 8, 'name' => 'Bluetooth', 'slug' => 'bluetooth', 'created_at' => $now],
            ['attribute_group_id' => 8, 'name' => 'Security', 'slug' => 'security', 'created_at' => $now],

            // Input devices
            ['attribute_group_id' => 9, 'name' => 'Keyboard', 'slug' => 'keyboard', 'created_at' => $now],
            ['attribute_group_id' => 9, 'name' => 'Webcam', 'slug' => 'webcam', 'created_at' => $now],

            // Audio
            ['attribute_group_id' => 10, 'name' => 'Speakers', 'slug' => 'speakers', 'created_at' => $now],
            ['attribute_group_id' => 10, 'name' => 'Microphone', 'slug' => 'microphone', 'created_at' => $now],

            // Battery
            ['attribute_group_id' => 11, 'name' => 'Capacity', 'slug' => 'capacity', 'created_at' => $now],
            ['attribute_group_id' => 11, 'name' => 'Charging', 'slug' => 'charging', 'created_at' => $now],


            /* -------------------------
         * ACCESSORIES ATTRIBUTES
         * ------------------------- */

            // Compatibility
            // ['attribute_group_id' => 12, 'name' => 'Device Type', 'slug' => 'device-type', 'created_at' => $now],
            // ['attribute_group_id' => 12, 'name' => 'Model Support', 'slug' => 'model-support', 'created_at' => $now],

            // // Connectivity
            // ['attribute_group_id' => 13, 'name' => 'Connection Type', 'slug' => 'connection-type', 'created_at' => $now],
            // ['attribute_group_id' => 13, 'name' => 'Wireless Range', 'slug' => 'wireless-range', 'created_at' => $now],

            // // Material
            // ['attribute_group_id' => 14, 'name' => 'Build Material', 'slug' => 'build-material', 'created_at' => $now],
            // ['attribute_group_id' => 14, 'name' => 'Water Resistance', 'slug' => 'water-resistance', 'created_at' => $now],

            // // Power
            // ['attribute_group_id' => 15, 'name' => 'Battery Life', 'slug' => 'battery-life', 'created_at' => $now],
            // ['attribute_group_id' => 15, 'name' => 'Charging Type', 'slug' => 'charging-type', 'created_at' => $now],
        ]);

        AttributeValue::insert([
            // ============================
            // BODY (attribute_id 1–3)
            // ============================

            // Dimension (generic common values)
            ['attribute_id' => 1, 'value' => 'Compact', 'slug' => 'compact', 'created_at' => $now],
            ['attribute_id' => 1, 'value' => 'Standard', 'slug' => 'standard', 'created_at' => $now],
            ['attribute_id' => 1, 'value' => 'Large', 'slug' => 'large', 'created_at' => $now],

            // Weight
            ['attribute_id' => 2, 'value' => '1kg – 1.5kg', 'slug' => '1kg-1-5kg', 'created_at' => $now],
            ['attribute_id' => 2, 'value' => '1.5kg – 2kg', 'slug' => '1-5kg-2kg', 'created_at' => $now],
            ['attribute_id' => 2, 'value' => 'Above 2kg', 'slug' => 'above-2kg', 'created_at' => $now],

            // Color
            ['attribute_id' => 3, 'value' => 'Black', 'slug' => 'black', 'created_at' => $now],
            ['attribute_id' => 3, 'value' => 'Silver', 'slug' => 'silver', 'created_at' => $now],
            ['attribute_id' => 3, 'value' => 'Gray', 'slug' => 'gray', 'created_at' => $now],
            ['attribute_id' => 3, 'value' => 'White', 'slug' => 'white', 'created_at' => $now],
            ['attribute_id' => 3, 'value' => 'Blue', 'slug' => 'blue', 'created_at' => $now],

            // ============================
            // CPU (attribute_id 4–7)
            // ============================

            // CPU Series
            ['attribute_id' => 4, 'value' => 'Intel Core i3', 'slug' => 'intel-core-i3', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'Intel Core i5', 'slug' => 'intel-core-i5', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'Intel Core i7', 'slug' => 'intel-core-i7', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'Intel Core i9', 'slug' => 'intel-core-i9', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'AMD Ryzen 3', 'slug' => 'amd-ryzen-3', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'AMD Ryzen 5', 'slug' => 'amd-ryzen-5', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'AMD Ryzen 7', 'slug' => 'amd-ryzen-7', 'created_at' => $now],
            ['attribute_id' => 4, 'value' => 'AMD Ryzen 9', 'slug' => 'amd-ryzen-9', 'created_at' => $now],

            // Processor Models (attribute_id = 5)
            ['attribute_id' => 5, 'value' => 'Intel Core i5-1235U', 'slug' => 'intel-core-i5-1235u', 'created_at' => $now],
            ['attribute_id' => 5, 'value' => 'Intel Core i7-12700H', 'slug' => 'intel-core-i7-12700h', 'created_at' => $now],
            ['attribute_id' => 5, 'value' => 'AMD Ryzen 5 5600H', 'slug' => 'amd-ryzen-5-5600h', 'created_at' => $now],
            ['attribute_id' => 5, 'value' => 'AMD Ryzen 7 5800H', 'slug' => 'amd-ryzen-7-5800h', 'created_at' => $now],

            // Cores (attribute_id = 6)
            ['attribute_id' => 6, 'value' => '4 Cores', 'slug' => '4-cores', 'created_at' => $now],
            ['attribute_id' => 6, 'value' => '6 Cores', 'slug' => '6-cores', 'created_at' => $now],
            ['attribute_id' => 6, 'value' => '8 Cores', 'slug' => '8-cores', 'created_at' => $now],
            ['attribute_id' => 6, 'value' => '12 Cores', 'slug' => '12-cores', 'created_at' => $now],

            // Threads (attribute_id = 7)
            ['attribute_id' => 7, 'value' => '8 Threads', 'slug' => '8-threads', 'created_at' => $now],
            ['attribute_id' => 7, 'value' => '12 Threads', 'slug' => '12-threads', 'created_at' => $now],
            ['attribute_id' => 7, 'value' => '16 Threads', 'slug' => '16-threads', 'created_at' => $now],
            ['attribute_id' => 7, 'value' => '20 Threads', 'slug' => '20-threads', 'created_at' => $now],

            // ============================
            // GRAPHICS (attribute_id 8–12)
            // ============================

            ['attribute_id' => 8, 'value' => 'NVIDIA RTX 3050', 'slug' => 'nvidia-rtx-3050', 'created_at' => $now],
            ['attribute_id' => 8, 'value' => 'NVIDIA RTX 3060', 'slug' => 'nvidia-rtx-3060', 'created_at' => $now],
            ['attribute_id' => 8, 'value' => 'NVIDIA RTX 4050', 'slug' => 'nvidia-rtx-4050', 'created_at' => $now],
            ['attribute_id' => 8, 'value' => 'AMD Radeon 680M', 'slug' => 'amd-radeon-680m', 'created_at' => $now],

            // Graphics Type (attribute_id = 9)
            ['attribute_id' => 9, 'value' => 'Integrated', 'slug' => 'integrated', 'created_at' => $now],
            ['attribute_id' => 9, 'value' => 'Dedicated', 'slug' => 'dedicated', 'created_at' => $now],

            // VRAM (attribute_id = 10)
            ['attribute_id' => 10, 'value' => '2GB', 'slug' => '2gb-vram', 'created_at' => $now],
            ['attribute_id' => 10, 'value' => '4GB', 'slug' => '4gb-vram', 'created_at' => $now],
            ['attribute_id' => 10, 'value' => '6GB', 'slug' => '6gb-vram', 'created_at' => $now],
            ['attribute_id' => 10, 'value' => '8GB', 'slug' => '8gb-vram', 'created_at' => $now],

            // Booster Clock (attribute_id = 12)
            ['attribute_id' => 11, 'value' => 'Boost up to 1500MHz', 'slug' => 'boost-1500mhz', 'created_at' => $now],
            ['attribute_id' => 11, 'value' => 'Boost up to 1800MHz', 'slug' => 'boost-1800mhz', 'created_at' => $now],
            ['attribute_id' => 11, 'value' => 'Boost up to 2000MHz', 'slug' => 'boost-2000mhz', 'created_at' => $now],

            // ============================
            // MEMORY (attribute_id 13–18)
            // ============================

            // Installed RAM
            ['attribute_id' => 12, 'value' => '8GB', 'slug' => '8gb', 'created_at' => $now],
            ['attribute_id' => 12, 'value' => '16GB', 'slug' => '16gb', 'created_at' => $now],
            ['attribute_id' => 12, 'value' => '32GB', 'slug' => '32gb', 'created_at' => $now],
            ['attribute_id' => 12, 'value' => '64GB', 'slug' => '64gb', 'created_at' => $now],

            // RAM Type (attribute_id = 15)
            ['attribute_id' => 13, 'value' => 'DDR4', 'slug' => 'ddr4', 'created_at' => $now],
            ['attribute_id' => 13, 'value' => 'DDR5', 'slug' => 'ddr5', 'created_at' => $now],

            // Frequency (attribute_id = 16)
            ['attribute_id' => 14, 'value' => '3200MHz', 'slug' => '3200mhz', 'created_at' => $now],
            ['attribute_id' => 14, 'value' => '4800MHz', 'slug' => '4800mhz', 'created_at' => $now],
            ['attribute_id' => 14, 'value' => '5200MHz', 'slug' => '5200mhz', 'created_at' => $now],

            // Channels (attribute_id = 17)
            ['attribute_id' => 15, 'value' => 'Single Channel', 'slug' => 'single-channel', 'created_at' => $now],
            ['attribute_id' => 15, 'value' => 'Dual Channel', 'slug' => 'dual-channel', 'created_at' => $now],

            // Max Capacity (attribute_id = 18)
            ['attribute_id' => 16, 'value' => 'Up to 32GB', 'slug' => 'up-to-32gb', 'created_at' => $now],
            ['attribute_id' => 16, 'value' => 'Up to 64GB', 'slug' => 'up-to-64gb', 'created_at' => $now],

            // ============================
            // STORAGE (attribute_id 19–20)
            // ============================

            ['attribute_id' => 17, 'value' => '256GB SSD', 'slug' => '256gb-ssd', 'created_at' => $now],
            ['attribute_id' => 17, 'value' => '512GB SSD', 'slug' => '512gb-ssd', 'created_at' => $now],
            ['attribute_id' => 17, 'value' => '1TB SSD', 'slug' => '1tb-ssd', 'created_at' => $now],
            ['attribute_id' => 17, 'value' => '2TB SSD', 'slug' => '2tb-ssd', 'created_at' => $now],

            // HDD (attribute_id = 20)
            ['attribute_id' => 18, 'value' => '1TB HDD', 'slug' => '1tb-hdd', 'created_at' => $now],
            ['attribute_id' => 18, 'value' => '2TB HDD', 'slug' => '2tb-hdd', 'created_at' => $now],

            // SSD Slots (attribute_id = 21)
            ['attribute_id' => 19, 'value' => '1x M.2 Slot', 'slug' => '1x-m2-slot', 'created_at' => $now],
            ['attribute_id' => 19, 'value' => '2x M.2 Slots', 'slug' => '2x-m2-slots', 'created_at' => $now],

            // Optical Drive (attribute_id = 22)
            ['attribute_id' => 20, 'value' => 'No Optical Drive', 'slug' => 'no-optical-drive', 'created_at' => $now],

            // ============================
            // DISPLAY (attribute_id 23–32)
            // ============================

            // Size
            ['attribute_id' => 21, 'value' => '14-inch', 'slug' => '14-inch', 'created_at' => $now],
            ['attribute_id' => 21, 'value' => '15.6-inch', 'slug' => '15-6-inch', 'created_at' => $now],
            ['attribute_id' => 21, 'value' => '16-inch', 'slug' => '16-inch', 'created_at' => $now],
            ['attribute_id' => 21, 'value' => '17-inch', 'slug' => '17-inch', 'created_at' => $now],

            // Panel Type
            ['attribute_id' => 22, 'value' => 'IPS', 'slug' => 'ips', 'created_at' => $now],
            ['attribute_id' => 22, 'value' => 'OLED', 'slug' => 'oled', 'created_at' => $now],
            ['attribute_id' => 22, 'value' => 'TN', 'slug' => 'tn', 'created_at' => $now],

            // Touch Screen
            ['attribute_id' => 23, 'value' => 'Yes', 'slug' => 'yes', 'created_at' => $now],
            ['attribute_id' => 23, 'value' => 'No', 'slug' => 'no', 'created_at' => $now],

            // Finish
            ['attribute_id' => 24, 'value' => 'Matte', 'slug' => 'matte', 'created_at' => $now],
            ['attribute_id' => 24, 'value' => 'Glossy', 'slug' => 'glossy', 'created_at' => $now],

            // Resolution
            ['attribute_id' => 25, 'value' => 'FHD (1920x1080)', 'slug' => 'fhd', 'created_at' => $now],
            ['attribute_id' => 25, 'value' => 'QHD (2560x1440)', 'slug' => 'qhd', 'created_at' => $now],
            ['attribute_id' => 25, 'value' => 'UHD (3840x2160)', 'slug' => 'uhd', 'created_at' => $now],

            // Refresh Rate
            ['attribute_id' => 26, 'value' => '60Hz', 'slug' => '60hz', 'created_at' => $now],
            ['attribute_id' => 26, 'value' => '120Hz', 'slug' => '120hz', 'created_at' => $now],
            ['attribute_id' => 26, 'value' => '144Hz', 'slug' => '144hz', 'created_at' => $now],
            ['attribute_id' => 26, 'value' => '165Hz', 'slug' => '165hz', 'created_at' => $now],

            // Brightness
            ['attribute_id' => 27, 'value' => '1500 Nits', 'slug' => '1500-nits', 'created_at' => $now],
            ['attribute_id' => 27, 'value' => '2400 Nits', 'slug' => '2400-nits', 'created_at' => $now],

            // ============================
            // I/O (attribute_id 30–31)
            // ============================

            ['attribute_id' => 28, 'value' => 'USB-A', 'slug' => 'usb-a', 'created_at' => $now],
            ['attribute_id' => 28, 'value' => 'USB-C', 'slug' => 'usb-c', 'created_at' => $now],
            ['attribute_id' => 28, 'value' => 'HDMI', 'slug' => 'hdmi', 'created_at' => $now],
            ['attribute_id' => 28, 'value' => 'Thunderbolt', 'slug' => 'thunderbolt', 'created_at' => $now],

            // USB-C type (attribute_id = 31)
            ['attribute_id' => 29, 'value' => 'USB-C 3.2', 'slug' => 'usb-c-3-2', 'created_at' => $now],
            ['attribute_id' => 29, 'value' => 'USB-C 4.0', 'slug' => 'usb-c-4-0', 'created_at' => $now],

            // ============================
            // COMMUNICATION (attribute_id 32–35)
            // ============================

            // Ethernet
            ['attribute_id' => 30, 'value' => '1 Gbps', 'slug' => '1gbps', 'created_at' => $now],
            ['attribute_id' => 30, 'value' => '2.5 Gbps', 'slug' => '2-5gbps', 'created_at' => $now],

            // WiFi
            ['attribute_id' => 31, 'value' => 'WiFi 5', 'slug' => 'wifi-5', 'created_at' => $now],
            ['attribute_id' => 31, 'value' => 'WiFi 6', 'slug' => 'wifi-6', 'created_at' => $now],
            ['attribute_id' => 31, 'value' => 'WiFi 6E', 'slug' => 'wifi-6e', 'created_at' => $now],

            // Bluetooth
            ['attribute_id' => 32, 'value' => 'Bluetooth 4.2', 'slug' => 'bluetooth-4-2', 'created_at' => $now],
            ['attribute_id' => 32, 'value' => 'Bluetooth 5.0', 'slug' => 'bluetooth-5-0', 'created_at' => $now],
            ['attribute_id' => 32, 'value' => 'Bluetooth 5.2', 'slug' => 'bluetooth-5-2', 'created_at' => $now],

            // Security
            ['attribute_id' => 33, 'value' => 'TPM 2.0', 'slug' => 'tpm-2-0', 'created_at' => $now],
            ['attribute_id' => 33, 'value' => 'Fingerprint', 'slug' => 'fingerprint', 'created_at' => $now],
            ['attribute_id' => 33, 'value' => 'Face Unlock', 'slug' => 'face-unlock', 'created_at' => $now],

            // ============================
            // INPUT DEVICES (attribute_id 36-37)
            // ============================

            ['attribute_id' => 34, 'value' => 'Backlit Keyboard', 'slug' => 'backlit-keyboard', 'created_at' => $now],
            ['attribute_id' => 34, 'value' => 'RGB Keyboard', 'slug' => 'rgb-keyboard', 'created_at' => $now],

            // Webcam
            ['attribute_id' => 35, 'value' => '720p', 'slug' => '720p', 'created_at' => $now],
            ['attribute_id' => 35, 'value' => '1080p', 'slug' => '1080p', 'created_at' => $now],

            // ============================
            // AUDIO (attribute_id 38-39)
            // ============================

            ['attribute_id' => 36, 'value' => 'Stereo Speakers', 'slug' => 'stereo-speakers', 'created_at' => $now],
            ['attribute_id' => 36, 'value' => 'Dolby Atmos', 'slug' => 'dolby-atmos', 'created_at' => $now],

            ['attribute_id' => 37, 'value' => 'Dual Microphones', 'slug' => 'dual-microphones', 'created_at' => $now],

            // ============================
            // BATTERY (attribute_id 40-41)
            // ============================

            ['attribute_id' => 38, 'value' => '50Wh', 'slug' => '50wh', 'created_at' => $now],
            ['attribute_id' => 38, 'value' => '70Wh', 'slug' => '70wh', 'created_at' => $now],
            ['attribute_id' => 38, 'value' => '99Wh', 'slug' => '99wh', 'created_at' => $now],

            ['attribute_id' => 39, 'value' => '65W Charging', 'slug' => '65w-charging', 'created_at' => $now],
            ['attribute_id' => 39, 'value' => '100W Charging', 'slug' => '100w-charging', 'created_at' => $now],
            ['attribute_id' => 39, 'value' => 'Type-C Charging', 'slug' => 'type-c-charging', 'created_at' => $now],

            // Accessories – Connection Type
            // ['attribute_id' => 44, 'value' => 'Wireless (2.4GHz)', 'slug' => 'wireless-2-4ghz', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Wired (USB-A)', 'slug' => 'wired-usb-a', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Wired (USB-C)', 'slug' => 'wired-usb-c', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Wired (3.5mm Audio)', 'slug' => 'wired-3-5mm', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Lightning', 'slug' => 'lightning', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Thunderbolt', 'slug' => 'thunderbolt', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'RF Receiver', 'slug' => 'rf-receiver', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Dual Mode (BT + 2.4GHz)', 'slug' => 'dual-mode-bt-2-4ghz', 'created_at' => $now],
            // ['attribute_id' => 44, 'value' => 'Wi-Fi', 'slug' => 'wifi', 'created_at' => $now],


            // // Accessories – Material
            // ['attribute_id' => 46, 'value' => 'ABS Plastic', 'slug' => 'abs-plastic', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Aluminum', 'slug' => 'aluminum', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Leather', 'slug' => 'leather', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Faux Leather', 'slug' => 'faux-leather', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Fabric', 'slug' => 'fabric', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Nylon', 'slug' => 'nylon', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Metal Alloy', 'slug' => 'metal-alloy', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Silicone', 'slug' => 'silicone', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Rubber', 'slug' => 'rubber', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Polycarbonate', 'slug' => 'polycarbonate', 'created_at' => $now],
            // ['attribute_id' => 46, 'value' => 'Stainless Steel', 'slug' => 'stainless-steel', 'created_at' => $now],
        ]);

                $this->command->info('Attribute Seeder run successfully!');

    }
}
