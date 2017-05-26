<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li {{{ (Request::is('/') ? 'class=active' : '') }}}><a href="{{ asset('/') }}">Home</a></li>
        <li {{{ (Request::is('users') ? 'class=active' : '') }}}><a href="{{ url('/users') }}">Users</a></li>
        <li {{{ (Request::is('blog_posts') ? 'class=active' : '') }}}><a href="{{ url('/blog_posts') }}">Blog</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>