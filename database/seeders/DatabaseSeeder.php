<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Concert;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name'=>'Admin StagePass','email'=>'admin@stagepass.com','phone'=>'081234567890','password'=>Hash::make('admin123'),'role'=>'admin']);
        User::create(['name'=>'Rina Kusuma','email'=>'user@stagepass.com','phone'=>'081234567891','password'=>Hash::make('user123'),'role'=>'customer']);

        $concerts = [
            ['title'=>'PINK FRIDAY 2 WORLD TOUR','artist'=>'Nicki Minaj','description'=>'Tur dunia mega spektakuler dari Nicki Minaj membawa album Pink Friday 2 yang fenomenal ke panggung Jakarta!','venue'=>'Gelora Bung Karno','city'=>'Jakarta','event_date'=>'2025-08-15','event_time'=>'19:00:00','poster_emoji'=>'👑','genre'=>'Hip-Hop / Rap','price'=>1500000,'quota'=>5000,'sold'=>1200,'bg_color'=>'#be185d'],
            ['title'=>'SHORT N\' SWEET TOUR','artist'=>'Sabrina Carpenter','description'=>'Sabrina Carpenter hadir untuk pertama kalinya di Indonesia dengan show yang manis dan penuh energi!','venue'=>'Indonesia Arena','city'=>'Jakarta','event_date'=>'2025-09-20','event_time'=>'20:00:00','poster_emoji'=>'🍬','genre'=>'Pop','price'=>950000,'quota'=>3000,'sold'=>2800,'bg_color'=>'#b45309'],
            ['title'=>'HIT ME HARD AND SOFT','artist'=>'Billie Eilish','description'=>'Billie Eilish kembali dengan tur dunia terbaru, membawa nuansa dark dan intimate yang memukau.','venue'=>'Beach City International Stadium','city'=>'Jakarta','event_date'=>'2025-10-05','event_time'=>'19:30:00','poster_emoji'=>'🖤','genre'=>'Alternative / Pop','price'=>1200000,'quota'=>4000,'sold'=>3500,'bg_color'=>'#1d4ed8'],
            ['title'=>'BEAUTIFUL CHAOS TOUR','artist'=>'KATSEYE','description'=>'KATSEYE girl group fenomenal hadir membawa Beautiful Chaos Tour yang akan membakar semangat para fan!','venue'=>'Tennis Indoor Senayan','city'=>'Jakarta','event_date'=>'2025-11-12','event_time'=>'18:00:00','poster_emoji'=>'✨','genre'=>'K-Pop','price'=>750000,'quota'=>2000,'sold'=>800,'bg_color'=>'#7c3aed'],
            ['title'=>'RENAISSANCE WORLD TOUR','artist'=>'Beyoncé','description'=>'The Queen Bey hadir dengan Renaissance World Tour — show terbesar dan termahal sepanjang sejarah musik dunia.','venue'=>'Gelora Bung Karno','city'=>'Jakarta','event_date'=>'2025-12-01','event_time'=>'20:00:00','poster_emoji'=>'🌟','genre'=>'R&B / Pop','price'=>2500000,'quota'=>8000,'sold'=>7500,'bg_color'=>'#854d0e'],
            ['title'=>'THE ERAS TOUR','artist'=>'Taylor Swift','description'=>'Taylor Swift membawa perjalanan musikal seluruh era karirnya ke panggung Indonesia dalam konser paling epik!','venue'=>'Gelora Bung Karno','city'=>'Jakarta','event_date'=>'2026-02-14','event_time'=>'19:00:00','poster_emoji'=>'🌈','genre'=>'Pop / Country','price'=>1800000,'quota'=>6000,'sold'=>100,'bg_color'=>'#0f766e'],
        ];

        foreach ($concerts as $c) Concert::create($c);
    }
}
