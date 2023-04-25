<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category\Utilities;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class UpdateIndexTest extends TestCase
{
    protected Category $category;

    protected Category $child;

    protected Category $newParent;

    protected Category $other;

    protected Category $otherChild;

    protected Category $parent;

    protected function setUp(): void
    {
        parent::setUp();

        /*
         * Parent       16
         * Category     16,66
         * Child        16,66,24
         * Other        16,666
         * OtherChild   16,666,12
         * NewParent    89
         *
         * BECOMES
         *
         * Parent       16
         * Other        16,666
         * OtherChild   16,666,12
         * NewParent    89
         * Category     89,66
         * Child        89,66,24
         */

        $this->parent = Category::factory()
            ->create([
                'id' => 16,
            ]);

        $this->category = Category::factory()
            ->forParent($this->parent)
            ->create([
                'id' => 66,
            ]);

        $this->child = Category::factory()
            ->forParent($this->category)
            ->create([
                'id' => 24,
            ]);

        $this->other = Category::factory()
            ->forParent($this->parent)
            ->create([
                'id' => 666,
            ]);

        $this->otherChild = Category::factory()
            ->forParent($this->other)
            ->create([
                'id' => 12,
            ]);

        $this->newParent = Category::factory()
            ->create([
                'id' => 89,
            ]);

        $this->category->parent()->associate($this->newParent);
        $this->category->save();
    }

    public function testCategoryIsReindexed(): void
    {
        $this->assertDatabaseHas('categories', [
            'id' => 66,
            'index' => '89,66',
        ]);
    }

    public function testChildIsReindexed(): void
    {
        $this->assertDatabaseHas('categories', [
            'id' => 24,
            'index' => '89,66,24',
        ]);
    }

    public function testParentIsUntouched(): void
    {
        $this->assertDatabaseHas('categories', [
            'id' => 16,
            'index' => '16',
        ]);
    }

    public function testOtherIsUntouched(): void
    {
        $this->assertDatabaseHas('categories', [
            'id' => 666,
            'index' => '16,666',
        ]);
    }

    public function testOtherChildIsUntouched(): void
    {
        $this->assertDatabaseHas('categories', [
            'id' => 12,
            'index' => '16,666,12',
        ]);
    }
}
