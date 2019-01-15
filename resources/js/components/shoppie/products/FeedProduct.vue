<template>
    <div class="border">
        <div class="central-meta item m-0" style="display: inline-block;">
            <div class="friend-info">
                <figure class="mb-0">
                    <img src="/images/avatars/0.jpg" alt="">
                </figure>
                <div class="friend-name">
                    <ins><a href="time-line.html" title="">Sophia</a></ins>
                    <span>published: january,5 2018 19:PM</span>
                </div>
            </div>
        </div>
        <product></product>
        <div class="central-meta item pt-0 m-0" style="display: inline-block;">
            <div class="user-post">
                <div class="coment-area">
                    <ul class="we-comet">
                        <li>
                            <div class="comet-avatar">
                                <img src="/images/avatars/0.jpg" alt="" style="width: 45px;">
                            </div>
                            <div class="we-comment">
                                <div class="coment-head">
                                    <h5><a href="time-line.html" title="">Jason borne</a></h5>
                                    <span>1 year ago</span>
                                </div>
                                <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel</p>
                            </div>

                        </li>
                        <li>
                            <div class="comet-avatar">
                                <img src="/images/avatars/0.jpg" alt="" style="width: 45px;">
                            </div>
                            <div class="we-comment">
                                <div class="coment-head">
                                    <h5><a href="time-line.html" title="">Sophia</a></h5>
                                    <span>1 week ago</span>
                                </div>
                                <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                                    <i class="em em-smiley"></i>
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" title="" class="showmore underline">more comments</a>
                        </li>
                        <li class="post-comment">
                            <div class="comet-avatar">
                                <img src="/images/avatars/0.jpg" alt="">
                            </div>
                            <div class="post-comt-box">
                                <form method="post">
                                    <textarea placeholder="Post your comment" class="form-control"></textarea>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from "./Product";
    export default {
        name: "FeedProduct",
        components: {Product}
    }
</script>

<style scoped>
    
</style>