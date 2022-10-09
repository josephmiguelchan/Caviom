@extends('public.v2.public_master')

@section('title', 'Featured Project')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Featured Project</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('charities.all')}}">Charitable Organization</a></li>
            <li><a href="{{route('charities.view')}}">San Roque United, Inc.</a></li>
            <li>Featured Project</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 entries">

            <article class="entry entry-single" data-aos="fade-up">

                <div class="entry-img">
                    <img src="{{asset('frontend/assets/img/blog-1.jpg')}}" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                    Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia reiciendis
                </h2>

                <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">San Roque United, Inc.</a></li>
                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                    </ul>
                </div>

                <div class="entry-content">
                <p>
                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                    Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
                </p>

                <p>
                    Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.
                </p>

                <blockquote>
                    <i class="icofont-quote-left quote-left"></i>
                    <p>
                        Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.
                    </p>
                    <i class="las la-quote-right quote-right"></i>
                    <i class="icofont-quote-right quote-right"></i>
                </blockquote>

                <p>
                    Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat.
                    Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque.
                    Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.
                </p>

                <h3>Et quae iure vel ut odit alias.</h3>
                <p>
                    Officiis animi maxime nulla quo et harum eum quis a. Sit hic in qui quos fugit ut rerum atque. Optio provident dolores atque voluptatem rem excepturi molestiae qui. Voluptatem laborum omnis ullam quibusdam perspiciatis nulla nostrum. Voluptatum est libero eum nesciunt aliquid qui.
                    Quia et suscipit non sequi. Maxime sed odit. Beatae nesciunt nesciunt accusamus quia aut ratione aspernatur dolor. Sint harum eveniet dicta exercitationem minima. Exercitationem omnis asperiores natus aperiam dolor consequatur id ex sed. Quibusdam rerum dolores sint consequatur quidem ea.
                    Beatae minima sunt libero soluta sapiente in rem assumenda. Et qui odit voluptatem. Cum quibusdam voluptatem voluptatem accusamus mollitia aut atque aut.
                </p>
                <img src="{{asset('frontend/assets/img/blog-5.jpg')}}" class="img-fluid" alt="">

                <h3>Ut repellat blanditiis est dolore sunt dolorum quae.</h3>
                <p>
                    Rerum ea est assumenda pariatur quasi et quam. Facilis nam porro amet nostrum. In assumenda quia quae a id praesentium. Quos deleniti libero sed occaecati aut porro autem. Consectetur sed excepturi sint non placeat quia repellat incidunt labore. Autem facilis hic dolorum dolores vel.
                    Consectetur quasi id et optio praesentium aut asperiores eaque aut. Explicabo omnis quibusdam esse. Ex libero illum iusto totam et ut aut blanditiis. Veritatis numquam ut illum ut a quam vitae.
                </p>
                <p>
                    Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                </p>

                </div>

                {{-- <div class="entry-footer clearfix">
                    <div class="float-left">
                        <i class="icofont-folder"></i>
                        <ul class="cats">
                        <li><a href="#">Business</a></li>
                        </ul>

                        <i class="icofont-tags"></i>
                        <ul class="tags">
                        <li><a href="#">Creative</a></li>
                        <li><a href="#">Tips</a></li>
                        <li><a href="#">Marketing</a></li>
                        </ul>
                    </div>

                    <div class="float-right share">
                        <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                        <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                        <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                    </div>

                </div> --}}

            </article><!-- End blog entry -->

            <div class="blog-author clearfix" data-aos="fade-up">
                <img src="{{asset('upload/charitable_org/profile_photo/SaRU.jpg')}}" class="rounded-circle float-left" alt="">
                <h4>San Roque United, Inc.</h4>
                {{-- <div class="social-links">
                    <a href="https://twitters.com/#"><i class="icofont-twitter"></i></a>
                    <a href="https://facebook.com/#"><i class="icofont-facebook"></i></a>
                    <a href="https://instagram.com/#"><i class="icofont-instagram"></i></a>
                </div> --}}
                <p class="mt-2">
                    (Objective) Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p>
            </div><!-- End blog author bio -->

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

            <div class="sidebar" data-aos="fade-left">

                <h3 class="sidebar-title">See Also</h3>
                <div class="sidebar-item recent-posts">
                    <div class="post-item clearfix">
                        <img src="{{asset('frontend/assets/img/blog-recent-posts-1.jpg')}}" alt="">
                        <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>

                    <div class="post-item clearfix">
                        <img src="{{asset('frontend/assets/img/blog-recent-posts-2.jpg')}}" alt="">
                        <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>

                    <div class="post-item clearfix">
                        <img src="{{asset('frontend/assets/img/blog-recent-posts-3.jpg')}}" alt="">
                        <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>

                    <div class="post-item clearfix">
                        <img src="{{asset('frontend/assets/img/blog-recent-posts-4.jpg')}}" alt="">
                        <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>

                    <div class="post-item clearfix">
                        <img src="{{asset('frontend/assets/img/blog-recent-posts-5.jpg')}}" alt="">
                        <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>

                </div><!-- End sidebar recent posts-->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>
<!-- End Blog Section -->

@endsection