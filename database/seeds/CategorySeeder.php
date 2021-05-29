<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategories(8, 4, 'post');
        $this->createCategories(8, 4, 'product');
    }

    /**
     * 创建两级分类。
     *
     * @param  int  $parent
     * @param  int  $children
     * @param  string  $type
     */
    protected function createCategories(int $parent, int $children, string $type)
    {
        $categories = factory(\App\Models\Category::class, $parent)->create(['type' => $type]);

        foreach ($categories as $category) {
            factory(\App\Models\Category::class, $children)->create([
                'parent_id' => $category->id,
                'type' => $type,
            ]);
        }
    }
}
