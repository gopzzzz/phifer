<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

  <body>
    <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>



                
                @include('layouts.partials.header') 
                
      
                
                @yield('content') 

                   

         
    </div>
  </div>

   @include('layouts.partials.footer-scripts')



  </body>
</html>