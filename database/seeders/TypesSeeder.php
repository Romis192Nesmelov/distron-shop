<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeeder extends Seeder
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
                'image' => 'storage/images/types/batteries.jpg',
                'name' => 'АКБ',
                'singular' => 'АКБ',
                'text' => '<p>Аккумуляторная батарея (АКБ) - это устройство, предназначенное для накопления и хранения электрической энергии в химической форме. АКБ служит источником питания для различных устройств и оборудования, когда отсутствует возможность подключения к сети электропитания.</p><p>Основными компонентами АКБ являются электроды (положительный и отрицательный) и электролит — проводящая среда между электродами. При разряде АКБ происходит химическая реакция, в результате которой на электродах образуются заряды, а электролит проводит ионы между ними, создавая электрический ток. При заряде АКБ происходит обратная реакция.<h2>Типы АКБ</h2><p>Существует множество типов АКБ, каждый из которых имеет свои характеристики и области применения:</p><ul><li>Свинцово-кислотные АКБ - наиболее распространенный тип АКБ, используемый в автомобилях, мотоциклах и других транспортных средствах.</li><li>Литий-ионные АКБ - более легкие и компактные, чем свинцово-кислотные, используются в ноутбуках, смартфонах и другой портативной электронике.</li><li>Никель-металлгидридные АКБ - имеют высокую плотность энергии и используются в гибридных автомобилях.</li><li>Никель-кадмиевые АКБ - отличаются длительным сроком службы и используются в промышленных приложениях.</li></ul><p>Компания ДиСтрон предлагает широкий ассортимент АКБ, как новые, так и восстановленные на нашем производстве с официальной гарантией 3 года.</p>',
                'is_service' => false,
            ],
            [
                'image' => 'storage/images/types/cells.jpg',
                'name' => 'Ячейки для АКБ',
                'singular' => 'Ячейка для АКБ',
                'text' => '<p>Sed convallis pretium urna nec accumsan. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In sagittis at metus sit amet egestas. Sed vel egestas est. Fusce ac pellentesque lectus, sit amet convallis neque. In a ante turpis. Pellentesque maximus nisi vitae augue tempus aliquet. Nullam eros leo, egestas nec pellentesque eu, laoreet nec nibh.</p><p>Aenean quam purus, malesuada id libero vel, faucibus commodo dui. Quisque at turpis ut ante bibendum tempor. Phasellus dolor dolor, fringilla sit amet imperdiet et, imperdiet ac sem. Ut suscipit faucibus mollis. Nam porttitor lacinia sem, eget sollicitudin purus pretium ut. Donec placerat maximus placerat. Nulla facilisi. Integer interdum nunc sodales, fringilla magna sit amet, commodo massa. Aliquam at ante volutpat enim vestibulum ultrices. Morbi aliquam urna elit, vel vehicula neque lacinia et. Duis libero lectus, dictum quis faucibus in, consectetur sed nisl. Vivamus et arcu ut augue hendrerit convallis. Vivamus molestie leo id nisl dapibus, ullamcorper facilisis lectus tempus. Etiam a vestibulum orci. Curabitur eget libero euismod, rutrum urna in, porta ante. Nam ut augue et ligula dignissim congue.</p>',
                'is_service' => false
            ],
            [
                'image' => 'storage/images/types/accessories.jpg',
                'name' =>'Аксессуары',
                'singular' => 'Аксессуар',
                'text' => '<p>Компания «ДиСтрон» не только восстанавливает аккумуляторные батареи с заводской гарантией, но и предлагает широкий спектр аксессуаров для АКБ, включая:</p><ul><li>Кабели и клеммы</li><li>Зарядные устройства</li><li>Индикаторы заряда</li><li>Системы управления батареями</li><li>Аккумуляторы для различных целей (автомобильные, морские, промышленные)</li></ul><p>За подробным перечнем аксессуаров обращайтесь:</p><p>По телефону: %phone%<br>Отправьте вопрос на почту – %mail%<br>Или заполните форму обратной связи на нашем сайте.</p>',
                'is_service' => false
            ],
            [
                'image' => 'storage/images/placeholder.jpg',
                'name' =>'Услуги',
                'singular' => 'Услуга',
                'text' => '<div class="row mb-4"><div class="col-md-3 col-sm-4 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="0.2s"><a class="fancybox w-100" href="/storage/images/services/photo1_full.jpg"><img class="image mb-3" src="/storage/images/services/photo1_preview.jpg" /></a></div><div class="col-md-3 col-sm-4 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="0.4s"><a class="fancybox w-100" href="/storage/images/services/photo2_full.jpg"><img class="image mb-3" src="/storage/images/services/photo2_preview.jpg" /></a></div><div class="col-md-3 col-sm-4 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="0.6s"><a class="fancybox w-100" href="/storage/images/services/photo3_full.jpg"><img class="image mb-3" src="/storage/images/services/photo3_preview.jpg" /></a></div><div class="col-md-3 col-sm-4 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="0.8s"><a class="fancybox w-100" href="/storage/images/services/photo4_full.jpg"><img class="image mb-3" src="/storage/images/services/photo4_preview.jpg" /></a></div></div><p>Процесс обслуживания АКБ проходит в несколько этапов.</p><p>Вначале проводится внешний осмотр АКБ на предмет наличия механических повреждений и других легко заметных факторов (протечка жидкости, состояние клемм и т.п.), указывающих на условия работы батареи, замеры остаточного напряжения и внутреннего сопротивления. Для кислотно-щелочных батарей проверяется уровень электролита и его плотность.</p><p>На втором этапе выполняется чистка батареи, замер весовых отклонений от заводских показателей. Проводится вскрытие АКБ и, при необходимости, добавление дистиллированной воды.</p><p>Далее выполняется предварительная зарядка элементов, после чего производится первый контрольный разряд АКБ, результаты которого достоверно показывают состояние АКБ и определяют программу восстановления рабочих характеристик.</p><p>Автоматизированный аппаратно-программный комплекс позволяет оптимизировать процессы заряда-разряда АКБ, помогает контролировать процессы нашим специалистам на каждом этапе работы с батареями.</p><p>Добавление запатентованной присадки BSI позволяет защитить проводящее покрытие на пластинах, предотвращает накопление отложений на пластинах и продлевает срок службы пластин, увеличивая срок службы аккумулятора в целом.</p>',
                'is_service' => true,
                'seo_id' => 6
            ],
        ];

        foreach ($data as $item) {
            Type::create($item);
        }
    }
}
