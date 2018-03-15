<?php

use App\Models\Training\Lesson\LessonsSettings as Model;
use Illuminate\Database\Seeder;

/**
 * Class LessonsSettings
 */
class LessonsSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! Model::first()) {
            $settings = [
                [
                    'key' => 'training_time',
                    'title' => 'Время на вопрос (тренировка)',
                    'value' => 1
                ],
                [
                    'key' => 'exam_time',
                    'title' => 'Время на вопрос (зачет)',
                    'value' => 1
                ]
            ];

            foreach ($settings as $setting) {
                Model::create($setting);
            }
        }
    }
}
