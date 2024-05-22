<?php
include 'inc/header.php';
?>
<!-- -->
<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Home</i></a>
                    <span>Blog</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Blog Section Begin-->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="blog-sidebar">
                    <div class="search-form">
                        <h4>Search</h4>
                        <form action="#">
                            <input type="text" id="live_search" placeholder="Search...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="blog-catagory">
                        <h4>Loại tin tức</h4>
                        <?php 
                        $cateblog=$category_blog->show_category_blog();
                        if($cateblog){
                            while($cateresult=$cateblog->fetch_assoc()){
                                ?>
                        <ul>
                            <li><a href=""><?=$cateresult['title']?></a></li>
                        </ul>
                                <?php
                            }
                        }
                        ?>
                    
                    </div>
                    <div class="recent-post">
                    <h4>Bài viết gần đây</h4>
                    <?php 
                        $show_blog=$blog->show_blog();
                        if($show_blog){
                            while($blogresult=$show_blog->fetch_assoc()){
                                ?>
                        <div class="recent-blog">
                            <a href="#" class="rb-item">
                                <div class="rb-pic">
                                <img src="uploads/<?=$blogresult['image']?>" alt="">
                                </div>
                                <div class="rb-text">
                                <h6><?=substr($blogresult['title'],0,17)."..."?></h6>
                                <p><?=substr($blogresult['description'],0,10)?><span><?=date('d/m/Y',strtotime($blogresult['created_at']))?></span> </p> 
                                </div>
                            </a>

                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="blog-tags">
                        <h4>Product Tags</h4>
                        <div class="tag-item">
                            <a href="">Towel</a>
                            <a href="">Shoes</a>
                            <a href="">Coat</a>
                            <a href="">Dresses</a>
                            <a href="">A</a>
                            <a href="">B</a>
                            <a href="">C</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row">
                <?php 
                        $show_blog=$blog->show_blog();
                        if($show_blog){
                            while($blogresult=$show_blog->fetch_assoc()){
                                ?>
                    <div class="col-lg-6 col-sm-6" id="search_result" >
                        <div class="blog-item">
                            <div class="bi-pic">
                            <img src="uploads/<?=$blogresult['image']?>" alt="">
                            </div>
                            <div class="bi-text">
                                <a href="blog-details.php?idblog=<?=$blogresult['id']?>">
                                    <h4><?=substr($blogresult['title'],0,32)."..."?></h4>
                                    <a href="">
                                        <p >
                                        <?php 
                                        $cateblog=$category_blog->show_category_blog();
                                        if($cateblog){
                                            while($cateresult=$cateblog->fetch_assoc()){
                                        ?>    
                                        <?=$blogresult['category_post_id']==$cateresult['id'] ? $cateresult['title'] : '' ?>
                                        <?php }} ?>
                                        
                                        <span><?=date('d/m/Y',strtotime($blogresult['created_at']))?></span></p>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End-->

<?php
include 'inc/footer.php';
?>