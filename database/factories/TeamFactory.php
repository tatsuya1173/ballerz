<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // ユーザーも同時に作成
            'prefecture_id' => Prefecture::inRandomOrder()->first()?->id ?? 1,
            'city' => $this->faker->city,
            'name' => $this->faker->company . ' FC',
            'grade_range' => $this->faker->randomElement(['1〜3年', '4〜6年', '全学年']),
            'practice_days' => json_encode($this->faker->randomElements(
                ['月', '火', '水', '木', '金', '土', '日'], rand(2, 4)
            )),
            'introduction' => $this->faker->paragraph,
        ];
    }
}