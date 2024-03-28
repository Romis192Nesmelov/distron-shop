<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Image;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'image' => 'images/contents/content1.jpg',
                'head' => 'О компании',
                'text' => '<p>Компания <b>«Дистрон»</b> была образована в 2011 году и по настоящее время является стабильным и надежным партнером для своих клиентов. На базе комплексного инновационного решения BSI для восстановления AGM-аккумуляторов и тяговых АКБ компания оказывает услуги по ремонту и восстановлению свинцовых аккумуляторов различной емкости.</p><p>Международная компания <b>«Battery Solution International Ltd.»</b>  оказывает передовые услуги по продлению срока службы батарей и их утилизации. Компания PSI technology разработала комплексное инновационное решение, в котором используются самые современные технологии наряду с добавлением специального вещества для полной процедуры восстановления аккумулятора.</p>'
            ],
            [
                'image' => 'images/contents/content2.png',
                'head' => 'Требования к АКБ',
                'text' => '<p>2В батареи – менее 0.7 мОм и минимальный интервал напряжения от 1.7В до 2.3В</p><p>12В батареи – менее 4.2 мОм и минимальный интервал напряжения от 10.2В до 13.8В</p>'
            ],
            [
                'image' => '',
                'head' => 'Партнерам',
                'text' => ''
            ],
        ];

        foreach ($data as $item) {
            $content = Content::create($item);
        }
    }
}
