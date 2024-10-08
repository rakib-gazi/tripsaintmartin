 
        const navbar = document.getElementById('header');
        const color = document.getElementById('text-color');
          window.addEventListener('scroll', function() {
              if (window.scrollY >= 50) {
                 navbar.classList.remove('bg-transparent',);
                 navbar.classList.add('bg-white',);
                 color.classList.remove('text-white');
                 color.classList.add('text-black',);
              } else {
                  navbar.classList.remove('bg-white', );
                 navbar.classList.add('bg-transparent', );
                 color.classList.remove('text-black',);
                  color.classList.add('text-white',);
              }
        });

        document.getElementById('nav-open').addEventListener('click', function(){
          const navopen = document.getElementById('phn-nav');
          navopen.classList.remove('hidden');
        })
        document.getElementById('cross-btn').addEventListener('click', function(){
          const navclose = document.getElementById('phn-nav');
          navclose.classList.add('hidden');
        })