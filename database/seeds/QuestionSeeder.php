<?php

use App\Models\Training\Processing\Question;
use App\Models\Training\Processing\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class QuestionSeeder
 */
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! Question::count()) {
            factory(Question::class, 500)->create()->each(function ($q) {
                $file = UploadedFile::fake()->image('avatar.jpg');
                Storage::put('public/question/' . $q->id . '/', $file);
                $q->answers()->createMany(factory(Answer::class, 4)->make()->toArray());
            });
        }
    }
}
