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
        <div class="recipe-comment">
            <div class="rounded-lg bg-gray-100 p-4">
                <?php echo wp_kses_post(wpautop($comment)); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($recipe_01)): ?>
        <div>
            <h3 class="font-bold">レシピ手順</h3>
            <?php if (is_array($recipe_01)): ?>
                <img src="<?php echo esc_url($recipe_01["url"]); ?>"
                     alt="<?php echo esc_attr(
                         $recipe_01["alt"] ?? "レシピ手順画像",
                     ); ?>"
                     class="step-image"/>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
