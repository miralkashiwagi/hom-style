<?php
/**
 * Block template for Lazy Blocks custom block
 *
 * Available fields:
 * - comment (Textarea Field)
 * - recipe-01 (Image Field)
 *
 * Available variables:
 * - $attributes: Array of block attributes
 * - $block: Block data object
 * - $context: Preview context ('editor' or 'frontend')
 */

// フィールドデータを取得
$comment = $attributes["comment"] ?? "";
$recipe_01 = $attributes["recipe-01"] ?? "";
$recipe_02 = $attributes["recipe-02"] ?? "";

// ブロックのユニークID
$block_id = "lazy-block-" . ($attributes["lazyBlockId"] ?? uniqid());

// ブロックのCSSクラス
$class_name = "wp-block-lazyblock-recipe-block";
if (!empty($attributes["className"])) {
    $class_name .= " " . $attributes["className"];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(
        $class_name,
); ?>">

    <?php if (!empty($comment)): ?>
        <h3 class="font-en text-lg mb-2xs">Comment</h3>
        <div class="rounded-xl bg-gray-bg p-sm text-sm">
            <?php echo wp_kses_post(wpautop($comment)); ?>
        </div>
    <?php endif; ?>

    <h3 class="font-en text-lg mt-xl mb-2xs">Recipe</h3>
    <div class="flex flex-col gap-sm">
        <?php if (!empty($recipe_01)): ?>
            <?php if (is_array($recipe_01)): ?>
                <div class="rounded-xl bg-gray-bg overflow-hidden">
                    <img src="<?php echo esc_url($recipe_01["url"]); ?>"
                         alt="<?php echo esc_attr(
                                 $recipe_01["alt"] ?? "レシピ画像01",
                         ); ?>"
                         class="step-image"/>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (!empty($recipe_02)): ?>
            <div class="rounded-xl bg-gray-bg overflow-hidden">
                <?php if (is_array($recipe_02)): ?>
                    <img src="<?php echo esc_url($recipe_02["url"]); ?>"
                         alt="<?php echo esc_attr(
                                 $recipe_02["alt"] ?? "レシピ画像02",
                         ); ?>"
                         class="step-image"/>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
