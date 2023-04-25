<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class RelationshipsTest extends TestCase
{
    public function testHasManyChildren(): void
    {
        $category = Category::factory()
            ->hasChildren(3)
            ->create();

        $this->assertCount(3, $category->children);

        foreach ($category->children as $child) {
            $this->assertInstanceOf(
                Category::class,
                $child,
            );
        }
    }

    public function testHasManyContents(): void
    {
        $category = Category::factory()
            ->hasContents(3)
            ->create();

        $this->assertCount(3, $category->contents);

        foreach ($category->contents as $content) {
            $this->assertInstanceOf(
                Content::class,
                $content,
            );
        }
    }

    public function testBelongsToParent(): void
    {
        $category = Category::factory()
            ->forParent()
            ->create();

        $this->assertInstanceOf(Category::class, $category->parent);
    }

    public function testBelongsToManyTags(): void
    {
        $category = Category::factory()
            ->hasTags(3)
            ->create();

        $this->assertCount(3, $category->tags);

        foreach ($category->tags as $tag) {
            $this->assertInstanceOf(
                Tag::class,
                $tag,
            );
        }
    }

    public function testHasSubcategories(): void
    {
        $category = Category::factory()
            ->hasChildren(3)
            ->create();

        $expected = $category->children;

        foreach ($category->children as $child) {
            $expected->push(
                Category::factory()
                    ->forParent($child)
                    ->create(),
            );
        }

        $unexpectedCategory = Category::factory()
            ->forParent()
            ->hasChildren(3)
            ->create();

        $unexpected = collect([
            $unexpectedCategory,
        ])
            ->push($unexpectedCategory->parent)
            ->merge($unexpectedCategory->children)
            ->push($category);

        $this->assertResultsMatch(
            $category->subcategories,
            $expected,
            $unexpected,
        );
    }

    public function testHasSubcontents(): void
    {
        $category = Category::factory()
            ->hasChildren(3)
            ->hasContents(3)
            ->create();

        $expected = $category->contents;

        foreach ($category->children as $child) {
            $expected->push(
                Content::factory()
                    ->forCategory($child)
                    ->create(),
            );
        }

        $unexpected = Content::factory()
            ->count(3)
            ->create();

        $this->assertResultsMatch(
            $category->subcontents,
            $expected,
            $unexpected,
        );
    }

    public function testHasAncestors(): void
    {
        $category = Category::factory()
            ->forParent()
            ->hasChildren()
            ->create();

        $expected = collect([
            $category->parent,
            $category,
        ]);

        $unexpected = Category::factory()
            ->count(3)
            ->create()
            ->push($category->children);

        $this->assertResultsMatch(
            $category->children->first()->ancestors,
            $expected,
            $unexpected,
        );

    }
}
