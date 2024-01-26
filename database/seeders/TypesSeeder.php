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
                'image' => 'images/types/batteries.jpg',
                'name' => 'АКБ',
                'singular' => 'АКБ',
                'text' => '<p>Duis dictum, neque non euismod auctor, purus orci bibendum ligula, placerat lacinia nisi lectus feugiat dui. Aliquam lobortis neque elit, a vehicula sem suscipit vel. Morbi in nulla ex. Mauris ex ipsum, hendrerit vel urna in, interdum sodales diam. Quisque suscipit convallis laoreet. Duis aliquet sapien elit, in imperdiet mauris mattis a. Phasellus imperdiet mi sed vestibulum molestie. Proin arcu justo, eleifend sed erat in, rhoncus viverra mauris. Vivamus massa tortor, molestie a elit quis, tristique semper odio.</p><p>Integer et nulla porttitor, pellentesque nibh iaculis, congue magna. Nulla euismod euismod vestibulum. Aenean vehicula nibh at molestie auctor. Fusce non rhoncus enim, sed imperdiet tortor. Donec lacinia, massa id lacinia accumsan, massa dolor hendrerit quam, nec bibendum mauris mauris quis metus. Curabitur sit amet volutpat diam. Mauris leo eros, euismod eget iaculis hendrerit, lacinia quis mi.</p>',
                'is_service' => false
            ],
            [
                'image' => 'images/types/cells.jpg',
                'name' => 'Ячейки для АКБ',
                'singular' => 'Ячейка для АКБ',
                'text' => '<p>Sed convallis pretium urna nec accumsan. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In sagittis at metus sit amet egestas. Sed vel egestas est. Fusce ac pellentesque lectus, sit amet convallis neque. In a ante turpis. Pellentesque maximus nisi vitae augue tempus aliquet. Nullam eros leo, egestas nec pellentesque eu, laoreet nec nibh.</p><p>Aenean quam purus, malesuada id libero vel, faucibus commodo dui. Quisque at turpis ut ante bibendum tempor. Phasellus dolor dolor, fringilla sit amet imperdiet et, imperdiet ac sem. Ut suscipit faucibus mollis. Nam porttitor lacinia sem, eget sollicitudin purus pretium ut. Donec placerat maximus placerat. Nulla facilisi. Integer interdum nunc sodales, fringilla magna sit amet, commodo massa. Aliquam at ante volutpat enim vestibulum ultrices. Morbi aliquam urna elit, vel vehicula neque lacinia et. Duis libero lectus, dictum quis faucibus in, consectetur sed nisl. Vivamus et arcu ut augue hendrerit convallis. Vivamus molestie leo id nisl dapibus, ullamcorper facilisis lectus tempus. Etiam a vestibulum orci. Curabitur eget libero euismod, rutrum urna in, porta ante. Nam ut augue et ligula dignissim congue.</p>',
                'is_service' => false
            ],
            [
                'image' => 'images/types/accessories.jpg',
                'name' =>'Аксессуары',
                'singular' => 'Аксессуар',
                'text' => '<p>Sed sed diam justo. Cras maximus porttitor ligula mattis sollicitudin. Sed vel ligula sed ex pulvinar elementum non eu arcu. Vestibulum in varius ex, eu consectetur odio. Pellentesque semper ut augue semper fringilla. Sed et ex sapien. Vivamus porttitor, nisl at sodales venenatis, urna diam eleifend turpis, ac faucibus neque quam sed tortor. Nullam eget gravida enim. Quisque dictum orci feugiat faucibus sagittis. Morbi elit mi, feugiat sed mollis vel, pharetra tempor metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam sem dolor, laoreet vel vulputate vitae, convallis eget nunc. Donec eu nisl accumsan, pharetra turpis eget, condimentum massa. Mauris molestie tincidunt cursus. Vivamus porta diam in libero imperdiet dictum. Mauris et augue tempus, eleifend felis eget, sollicitudin enim.</p><p>Cras at mi suscipit, efficitur est nec, rutrum sapien. Sed feugiat et erat suscipit pellentesque. Curabitur sed elit felis. Donec bibendum condimentum pharetra. Quisque sit amet sapien metus. Nam consectetur vestibulum massa, sed tempus ipsum euismod ut. Suspendisse auctor vestibulum enim. Vestibulum et lectus id nisl pharetra molestie non sed purus. Suspendisse lacus enim, aliquam quis nulla scelerisque, consequat tempus leo. Proin dapibus quam at sem volutpat accumsan in ut nibh. Morbi sit amet sapien scelerisque, molestie nisi varius, mattis massa. In vel fringilla tellus. Nullam vitae fringilla metus, nec fermentum massa. Suspendisse potenti. Cras tincidunt fermentum leo sit amet commodo.</p>',
                'is_service' => false
            ],
            [
                'image' => 'images/placeholder.jpg',
                'name' =>'Описание услуг',
                'singular' => 'Услуга',
                'text' => '<p>Процесс обслуживания АКБ проходит в несколько этапов.</p><p>Вначале проводится внешний осмотр АКБ на предмет наличия механических повреждений и других легко заметных факторов (протечка жидкости, состояние клемм и т.п.), указывающих на условия работы батареи, замеры остаточного напряжения и внутреннего сопротивления. Для кислотно-щелочных батарей проверяется уровень электролита и его плотность.</p><p>На втором этапе выполняется чистка батареи, замер весовых отклонений от заводских показателей. Проводится вскрытие АКБ и, при необходимости, добавление дистиллированной воды.</p><p>Далее выполняется предварительная зарядка элементов, после чего производится первый контрольный разряд АКБ, результаты которого достоверно показывают состояние АКБ и определяют программу восстановления рабочих характеристик.</p><p>Автоматизированный аппаратно-программный комплекс позволяет оптимизировать процессы заряда-разряда АКБ, помогает контролировать процессы нашим специалистам на каждом этапе работы с батареями.</p><p>Добавление запатентованной присадки BSI позволяет защитить проводящее покрытие на пластинах, предотвращает накопление отложений на пластинах и продлевает срок службы пластин, увеличивая срок службы аккумулятора в целом.</p>
',
                'is_service' => true
            ],
        ];

        foreach ($data as $item) {
            Type::create($item);
        }
    }
}
