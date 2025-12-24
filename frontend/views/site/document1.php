<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view presents the first archival document narrative.
 */
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '抗日宣言详情';
$this->params['breadcrumbs'][] = ['label' => '抗战历史', 'url' => ['/site/history']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* 抗战主题背景图片 */
    body {
        background-image: url('<?= Url::to('@web/img/china-map-bg.jpg') ?>');
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">抗日宣言详情</h1>
    <a href="<?= Url::to(['/site/history']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回历史页面
    </a>
</div>

<!-- 文档内容 -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">中国共产党抗日救国十大纲领</h6>
            </div>
            <div class="card-body">
                <div class="document-header">
                    <h4 class="text-center mb-3">抗日救国十大纲领</h4>
                    <p class="text-center text-muted">发布日期：1937年8月25日</p>
                    <p class="text-center text-muted">发布机构：中国共产党中央委员会</p>
                </div>

                <div class="document-content">
                    <p>全国同胞们！</p>

                    <p>中国共产党中央委员会，谨以至诚，向我全国父老兄弟及各界同胞宣言：当此国难极端严重民族生命存亡绝续之时，我们为着挽救祖国的危亡，在和平统一团结御侮的基础上，已经将日寇侵略者认为全国一致的公敌。</p>

                    <p>中国共产党中央委员会特向全国同胞提出下列抗日救国十大纲领，如蒙全国同胞一致赞助和实行之，则民族生存之危险庶几可以挽救，否则后患不堪设想矣。</p>

                    <h5>一、打倒日本帝国主义</h5>
                    <p>对日绝交，宣布一切条约无效，收回一切失地，取消日本在华一切特权，否认伪满洲国。</p>

                    <h5>二、全国军事的总动员</h5>
                    <p>动员全国陆海空军，实行全国抗战，开放民众运动，武装民众，实行自卫。</p>

                    <h5>三、全国人民的总动员</h5>
                    <p>全国人民除汉奸外，都有抗日救国的言论、出版、集会、结社和武装抗战的自由。</p>

                    <h5>四、改革政治机构</h5>
                    <p>召集真正人民代表的国民大会，通过真正的民主宪法，决定抗日救国方针，选举国防政府。</p>

                    <h5>五、实行抗日的外交政策</h5>
                    <p>联合一切反对日本帝国主义的国家，订立抗日联盟，共同反对日本帝国主义。</p>

                    <h5>六、实行战时的财政经济政策</h5>
                    <p>财政政策以有钱出钱为原则，经济政策以国营经济为主体，保护民族工商业。</p>

                    <h5>七、改良人民生活</h5>
                    <p>改良工人、农民、士兵及教员的生活，增加工资，减租减息，改善士兵待遇。</p>

                    <h5>八、实行抗日的教育政策</h5>
                    <p>改变教育的方针和方法，实行抗日的教育，普及抗日教育于全国人民之中。</p>

                    <h5>九、肃清汉奸卖国贼亲日派</h5>
                    <p>巩固后方，肃清汉奸卖国贼亲日派，实行革命的法令，改良司法制度。</p>

                    <h5>十、实行合理的民族政策</h5>
                    <p>允许蒙、回、藏、苗、瑶、夷、番各民族与汉族有平等权利，在共同抗日原则之下，有自己管理自己事务之权。</p>

                    <p>全国同胞们！中国共产党中央委员会郑重声明：我们赞助建立全国统一的民主共和国，赞助全国人民和抗日军队的抗日救国运动。我们愿意和全国一切政党、一切军队、一切人民，联合起来，组成统一的抗日民族阵线。</p>

                    <p>中国共产党中央委员会</p>
                    <p>一九三七年八月二十五日</p>
                </div>

                <div class="mt-4">
                    <img src="<?= Url::to('@web/img/document1.jpg') ?>" alt="抗日宣言原件" class="document-image" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                    <p class="text-muted text-center mt-2">抗日宣言历史文献照片</p>
                </div>

                <div class="mt-4">
                    <h5>历史意义</h5>
                    <p>中国共产党抗日救国十大纲领的提出，标志着中国共产党在抗日民族统一战线策略上的重大发展。这个纲领不仅提出了明确的抗日主张，更重要的是提出了建立民主共和国的政治目标，为抗日战争的胜利奠定了政治基础。</p>

                    <p>十大纲领的提出，推动了国共两党的第二次合作，形成了抗日民族统一战线，为全民族抗战的展开创造了条件。</p>
                </div>
            </div>
        </div>
    </div>
</div>
