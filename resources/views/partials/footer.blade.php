@if (Auth::guest())
<div class="ample-facebook-signup">
   <div class="inner-section">
      <div class="heading">Join us and get access
          to all your favourite books</div>
       <div class="free">It’s free</div>
       <button data-toggle="modal" data-target="#myModal">Sign up for free</button>
   </div>
</div>
@endif
<div class="ample-footer">
<div class="ample-logo">
    <img src="/images/logo-footer.png" / alt="ample logo">
</div>
<div class="ample-footer-right">
    <div class="footer-r1">
        <div class="heading">Company</div>
         <ul>
             <li>{!! HTML::link(url('/about-us'), 'About us') !!}</li>
             <li>{!! HTML::link(url('/contact-us'), 'Contact us') !!}</li>
             <li>{!! HTML::link(url('/career'), 'Career') !!}</li>
             <li>{!! HTML::link(url('/terms'), 'Terms') !!}</li>
             <li>{!! HTML::link(url('/privacy'), 'Privacy') !!}</li>
         </ul>
    </div>
    <div class="footer-r1">
        <div class="heading">Books</div>
        <ul>
            <li><a href="/books/category/free-books">Free eBooks</a></li>
            <li><a href="/books/category/paid-books">Paid eBooks</a></li>
            <li>{!! HTML::link(url('/subscription'), 'Subscription') !!}</li>
            <li>{!! HTML::link(url('/help'), 'Help') !!}</li>
        </ul>
    </div>
    <div class="footer-r1">
        <div class="heading">Links</div>
        <div class="ample-social">
            <div class="twitter"><i class="fab fa-twitter"></i></div>
            <div class="facebook"><i class="fab fa-facebook-f"></i></div>
            <div class="instagram"><i class="fab fa-instagram"></i></div>
        </div>
    </div>
    <div class="footer-r1">
        <div class="heading">Stay in touch</div>
        <input type="text" placeholder="Email">
        <button>Send</button>
    </div>
</div>
<div class="ample-lower-footer">© 2017 AMPLE reads</div>
</div>
<div class="ample-signup-register"></div>