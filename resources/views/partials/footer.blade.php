<footer class="footer">
  <div class="footer-holder container">
    <figure  class="banner-holder">
      <p><strong>Mesto za vašu reklamu!</strong> <br><br><a href="mailto:info@preporukazafilm.com">Kontaktirajte nas</a> i saznajte više o mogućnostima oglašavanja!</p>
      {{-- <img src="@asset('images/partials/footer-banner.webp')" alt="Banner Add"> --}}
      {{-- <figcaption>Big discounts on summer clothes!</figcaption> --}}
    </figure>

    <section class="footer-cta">
      <h2 class="footer-title">Najbrža besplatna preporuka za film</h2>
      <p class="footer-text">Odgovorite na 6 kratkih pitanja, i uživajte u najboljim filmovima za vas.</p>
      <a href="{{ url('/anketa') }}" class="footer-btn">POČNI ODMAH</a>
    </section>
    
    <ul class="footer-content">
      <li class="footer-logo">
        <img class="desktop-logo" src="@asset('images/partials/preporuka-za-film-logo.svg')" alt="Footer Logo" loading="lazy">
        <img class="mobile-logo" src="@asset('images/partials/footer-logo.svg')" alt="Footer Logo" loading="lazy">        
      </li>

      <li class="footer-link-item"><a href="{{ home_url() }}/">Početna</a></li>
      <li class="footer-link-item"><a href="{{ home_url() }}/blog">Blog</a></li>
      <li class="footer-link-item"><a href="{{ home_url() }}/kontakt">Kontakt</a></li>

      <li class="footer-justweb">
        <a href="https://justweb.rs/" aria-label="JustWeb" target="_blank" rel="noopener">
          <svg width="100" height="64" viewBox="0 0 100 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="100" height="64" rx="4" fill="#22374A"/>
            <path d="M83.767 30.2124C83.105 30.2124 82.5069 30.0724 81.9723 29.7924C81.4378 29.5123 81.0115 29.1305 80.6932 28.6469C80.3749 28.1632 80.2031 27.6223 80.1777 27.0241V23.7403C80.2031 23.1421 80.3749 22.6075 80.6932 22.1366C81.024 21.6529 81.4569 21.2775 81.9914 21.0102C82.526 20.7429 83.1178 20.6093 83.767 20.6093C84.6198 20.6093 85.3835 20.8193 86.058 21.2393C86.7324 21.6593 87.2607 22.232 87.6426 22.9575C88.0372 23.683 88.2344 24.504 88.2344 25.4204C88.2344 26.324 88.0372 27.1386 87.6426 27.8641C87.2607 28.5896 86.7324 29.1623 86.058 29.5823C85.3835 30.0024 84.6198 30.2124 83.767 30.2124ZM78.6504 30.0215V16.0007H81.1514V23.0721L80.7314 25.2867L81.1323 27.5395V30.0215H78.6504ZM83.3469 27.9023C83.8051 27.9023 84.2061 27.8005 84.5497 27.5968C84.9062 27.3804 85.1797 27.0877 85.3707 26.7186C85.5744 26.3368 85.6761 25.8977 85.6761 25.4013C85.6761 24.9176 85.5744 24.4912 85.3707 24.1221C85.1797 23.7403 84.9062 23.4476 84.5497 23.2439C84.1932 23.0275 83.7861 22.9193 83.3279 22.9193C82.8697 22.9193 82.4625 23.0275 82.106 23.2439C81.7623 23.4476 81.4888 23.7403 81.285 24.1221C81.0941 24.4912 80.9987 24.9176 80.9987 25.4013C80.9987 25.8977 81.0941 26.3368 81.285 26.7186C81.4888 27.0877 81.7686 27.3804 82.1251 27.5968C82.4816 27.8005 82.8887 27.9023 83.3469 27.9023Z" fill="white"/>
            <path d="M72.7301 30.2125C71.763 30.2125 70.9039 30.0089 70.1527 29.6016C69.4019 29.1816 68.8038 28.6088 68.3581 27.8834C67.9256 27.1579 67.709 26.3306 67.709 25.4014C67.709 24.485 67.919 23.6704 68.339 22.9577C68.7719 22.2322 69.3574 21.6595 70.0954 21.2394C70.8338 20.8067 71.6547 20.5903 72.5583 20.5903C73.4493 20.5903 74.2321 20.794 74.9065 21.2013C75.5938 21.5958 76.1284 22.1431 76.5103 22.8432C76.9049 23.5305 77.1021 24.3132 77.1021 25.1914C77.1021 25.3569 77.0896 25.5287 77.0639 25.7069C77.0514 25.8724 77.0195 26.0633 76.9685 26.2797L69.2172 26.2987V24.4278L75.8039 24.4087L74.792 25.1914C74.7666 24.6441 74.6649 24.1859 74.4865 23.8168C74.3213 23.4477 74.0731 23.1677 73.742 22.9768C73.424 22.7731 73.0293 22.6713 72.5583 22.6713C72.0619 22.6713 71.6293 22.7859 71.26 23.015C70.891 23.2313 70.6047 23.5432 70.4009 23.9505C70.21 24.345 70.1145 24.8159 70.1145 25.3633C70.1145 25.9233 70.2166 26.4133 70.42 26.8333C70.6366 27.2406 70.942 27.5588 71.3364 27.7879C71.7311 28.0043 72.1893 28.1125 72.711 28.1125C73.182 28.1125 73.6083 28.0361 73.9901 27.8834C74.372 27.7179 74.7031 27.4761 74.9829 27.1579L76.453 28.6279C76.0076 29.1498 75.4602 29.5443 74.8111 29.8116C74.1748 30.0789 73.4812 30.2125 72.7301 30.2125Z" fill="white"/>
            <path d="M54.3245 30L50 16H52.5416L55.7471 26.7738H54.8936L58.0421 16H59.9579L63.1064 26.7738H62.234L65.4584 16H68L63.6566 30H61.7408L58.5731 19.2461H59.4077L56.2592 30H54.3245Z" fill="white"/>
            <path d="M44.4764 30.022L44.4764 16H46.9941V30.022H44.4764ZM42.3047 22.9603V20.7535H49.1658V22.9603H42.3047Z" fill="white"/>
            <path d="M37.9116 30.2319C37.3898 30.2319 36.8743 30.1619 36.3652 30.0219C35.8688 29.8819 35.4106 29.691 34.9906 29.4492C34.5706 29.1946 34.2078 28.8892 33.9023 28.5328L35.3915 27.0245C35.7097 27.3809 36.0788 27.6482 36.4988 27.8264C36.9188 28.0046 37.3834 28.0937 37.8925 28.0937C38.2997 28.0937 38.6051 28.0364 38.8089 27.9218C39.0252 27.8073 39.1334 27.6355 39.1334 27.4064C39.1334 27.1518 39.0189 26.9545 38.7898 26.8145C38.5735 26.6745 38.2871 26.56 37.9307 26.4709C37.5743 26.3691 37.1989 26.2609 36.8043 26.1463C36.4224 26.019 36.0534 25.8599 35.697 25.669C35.3406 25.4654 35.0478 25.1917 34.8187 24.8481C34.6024 24.4917 34.4942 24.0335 34.4942 23.4735C34.4942 22.888 34.6342 22.3789 34.9142 21.9461C35.207 21.5134 35.6206 21.1761 36.1552 20.9343C36.6897 20.6924 37.3198 20.5715 38.0452 20.5715C38.8089 20.5715 39.4962 20.7052 40.1071 20.9725C40.7309 21.2397 41.2463 21.6407 41.6535 22.1752L40.1453 23.6835C39.8652 23.3398 39.5472 23.0916 39.1907 22.9389C38.8471 22.7862 38.4715 22.7098 38.0643 22.7098C37.6952 22.7098 37.4089 22.7671 37.2052 22.8816C37.0143 22.9962 36.9188 23.1553 36.9188 23.3589C36.9188 23.588 37.027 23.7662 37.2434 23.8935C37.4725 24.0208 37.7652 24.1353 38.1216 24.2371C38.4781 24.3262 38.8471 24.4344 39.2289 24.5617C39.6236 24.6762 39.9926 24.8417 40.3362 25.0581C40.6927 25.2744 40.9791 25.5608 41.1953 25.9172C41.4244 26.2736 41.539 26.7318 41.539 27.2918C41.539 28.1955 41.2144 28.9146 40.5653 29.4492C39.9162 29.971 39.0317 30.2319 37.9116 30.2319Z" fill="white"/>
            <path d="M28.5873 30.211C27.7727 30.211 27.0473 30.0392 26.4109 29.6956C25.7872 29.3519 25.2972 28.8746 24.9408 28.2637C24.5844 27.6527 24.4062 26.9464 24.4062 26.1445V20.7988H26.9264V26.0872C26.9264 26.4691 26.99 26.8 27.1173 27.08C27.2446 27.3473 27.4355 27.5509 27.69 27.6909C27.9446 27.8309 28.2437 27.9009 28.5873 27.9009C29.1092 27.9009 29.5165 27.7418 29.8092 27.4236C30.1019 27.1054 30.2483 26.66 30.2483 26.0872V20.7988H32.7493V26.1445C32.7493 26.9591 32.5711 27.6718 32.2148 28.2828C31.8711 28.8937 31.3811 29.371 30.7447 29.7146C30.121 30.0456 29.4019 30.211 28.5873 30.211Z" fill="white"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3882 16.7694C17.6706 16.4068 16.8951 16.1667 16.0939 16.0613C15.0051 15.9179 13.898 16.027 12.8581 16.3799C11.8182 16.7329 10.8735 17.3204 10.0969 18.0969C9.94982 18.2441 9.80949 18.3972 9.67625 18.5559L11.6903 19.8659C11.7188 19.8359 11.7477 19.8063 11.777 19.777C12.2958 19.2581 12.927 18.8656 13.6218 18.6298C14.3166 18.3939 15.0563 18.3211 15.7837 18.4168C16.2325 18.4759 16.6692 18.5982 17.0811 18.7789L18.3882 16.7694ZM10.7226 21.3716L8.70575 20.0598C8.58153 20.3185 8.47265 20.585 8.37995 20.8581C8.02696 21.898 7.91791 23.0051 8.06125 24.0939C8.20459 25.1826 8.59647 26.2238 9.20658 27.1369C9.60129 27.7277 10.0805 28.2545 10.6272 28.7016L11.9342 26.6921C11.65 26.4326 11.3973 26.139 11.1821 25.8169C10.7744 25.2069 10.5126 24.5112 10.4168 23.7837C10.3211 23.0563 10.3939 22.3166 10.6298 21.6218C10.6584 21.5374 10.6894 21.454 10.7226 21.3716Z" fill="#B287FF"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3135 16.7694C17.5959 16.4068 16.8204 16.1667 16.0192 16.0613C14.9304 15.9179 13.8233 16.027 12.7834 16.3799C11.7435 16.7329 10.7988 17.3204 10.0222 18.0969C9.87513 18.2441 9.7348 18.3972 9.60156 18.5559L11.6156 19.8659C11.6441 19.8359 11.673 19.8063 11.7023 19.777C12.2211 19.2581 12.8523 18.8656 13.5471 18.6298C14.2419 18.3939 14.9816 18.3211 15.7091 18.4168C16.1578 18.4759 16.5945 18.5982 17.0065 18.7789L18.3135 16.7694Z" fill="#5ACBFF"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9398 16H22.3263V23.1594C22.3263 24.4161 21.9954 25.6507 21.3671 26.7391C20.7387 27.8275 19.8349 28.7312 18.7466 29.3596C17.6582 29.9879 16.4236 30.3188 15.1669 30.3188C14.1605 30.3188 13.1682 30.1066 12.2539 29.6994L13.6089 27.682C14.1082 27.854 14.6346 27.9428 15.1669 27.9428C16.0066 27.9428 16.8314 27.7218 17.5586 27.302C18.2858 26.8821 18.8896 26.2783 19.3095 25.5511C19.7293 24.8239 19.9503 23.9991 19.9503 23.1594H19.9398V16Z" fill="white"/>
            <path opacity="0.8" d="M20.1045 55.3H21.6845C22.0911 55.3 22.4678 55.23 22.8145 55.09C23.1611 54.95 23.4645 54.7533 23.7245 54.5C23.9845 54.2467 24.1845 53.95 24.3245 53.61C24.4711 53.27 24.5445 52.9 24.5445 52.5C24.5445 52.1 24.4711 51.73 24.3245 51.39C24.1845 51.05 23.9845 50.7533 23.7245 50.5C23.4645 50.2467 23.1611 50.05 22.8145 49.91C22.4678 49.77 22.0911 49.7 21.6845 49.7H20.1045V55.3ZM19.3345 56V49H21.6445C22.1778 49 22.6678 49.0867 23.1145 49.26C23.5611 49.4333 23.9478 49.6767 24.2745 49.99C24.6078 50.3033 24.8645 50.6733 25.0445 51.1C25.2311 51.5267 25.3245 51.9933 25.3245 52.5C25.3245 53.0067 25.2345 53.4733 25.0545 53.9C24.8745 54.3267 24.6178 54.6967 24.2845 55.01C23.9578 55.3233 23.5678 55.5667 23.1145 55.74C22.6678 55.9133 22.1778 56 21.6445 56H19.3345ZM28.7417 56.09C28.2617 56.09 27.8251 55.9767 27.4317 55.75C27.0451 55.5167 26.7351 55.2033 26.5017 54.81C26.2751 54.4167 26.1617 53.9767 26.1617 53.49C26.1617 53.01 26.2717 52.5767 26.4917 52.19C26.7117 51.7967 27.0084 51.4867 27.3817 51.26C27.7551 51.0267 28.1717 50.91 28.6317 50.91C29.0784 50.91 29.4784 51.0267 29.8317 51.26C30.1917 51.4867 30.4751 51.7967 30.6817 52.19C30.8951 52.5767 31.0017 53.01 31.0017 53.49V53.72H26.8917C26.9317 54.0467 27.0351 54.34 27.2017 54.6C27.3751 54.86 27.5984 55.0667 27.8717 55.22C28.1451 55.3667 28.4451 55.44 28.7717 55.44C29.0317 55.44 29.2851 55.4 29.5317 55.32C29.7784 55.24 29.9851 55.1267 30.1517 54.98L30.6117 55.47C30.3317 55.6767 30.0384 55.8333 29.7317 55.94C29.4317 56.04 29.1017 56.09 28.7417 56.09ZM26.9117 53.13H30.2617C30.2217 52.83 30.1217 52.5633 29.9617 52.33C29.8084 52.09 29.6151 51.9033 29.3817 51.77C29.1484 51.63 28.8917 51.56 28.6117 51.56C28.3251 51.56 28.0617 51.6267 27.8217 51.76C27.5817 51.8933 27.3817 52.08 27.2217 52.32C27.0617 52.5533 26.9584 52.8233 26.9117 53.13ZM33.4798 56L31.3098 50.99H32.1298L33.8398 55.04L35.5498 50.99H36.3398L34.1798 56H33.4798ZM39.2202 56.09C38.7402 56.09 38.3036 55.9767 37.9102 55.75C37.5236 55.5167 37.2136 55.2033 36.9802 54.81C36.7536 54.4167 36.6402 53.9767 36.6402 53.49C36.6402 53.01 36.7502 52.5767 36.9702 52.19C37.1902 51.7967 37.4869 51.4867 37.8602 51.26C38.2336 51.0267 38.6502 50.91 39.1102 50.91C39.5569 50.91 39.9569 51.0267 40.3102 51.26C40.6702 51.4867 40.9536 51.7967 41.1602 52.19C41.3736 52.5767 41.4802 53.01 41.4802 53.49V53.72H37.3702C37.4102 54.0467 37.5136 54.34 37.6802 54.6C37.8536 54.86 38.0769 55.0667 38.3502 55.22C38.6236 55.3667 38.9236 55.44 39.2502 55.44C39.5102 55.44 39.7636 55.4 40.0102 55.32C40.2569 55.24 40.4636 55.1267 40.6302 54.98L41.0902 55.47C40.8102 55.6767 40.5169 55.8333 40.2102 55.94C39.9102 56.04 39.5802 56.09 39.2202 56.09ZM37.3902 53.13H40.7402C40.7002 52.83 40.6002 52.5633 40.4402 52.33C40.2869 52.09 40.0936 51.9033 39.8602 51.77C39.6269 51.63 39.3702 51.56 39.0902 51.56C38.8036 51.56 38.5402 51.6267 38.3002 51.76C38.0602 51.8933 37.8602 52.08 37.7002 52.32C37.5402 52.5533 37.4369 52.8233 37.3902 53.13ZM42.5148 56V49L43.2548 48.83V56H42.5148ZM46.8467 56.1C46.3734 56.1 45.9401 55.9867 45.5467 55.76C45.1601 55.5267 44.8534 55.2133 44.6267 54.82C44.4001 54.4267 44.2867 53.9867 44.2867 53.5C44.2867 53.0133 44.4001 52.5733 44.6267 52.18C44.8534 51.7867 45.1601 51.4767 45.5467 51.25C45.9401 51.0167 46.3734 50.9 46.8467 50.9C47.3267 50.9 47.7601 51.0167 48.1467 51.25C48.5334 51.4767 48.8401 51.7867 49.0667 52.18C49.2934 52.5733 49.4067 53.0133 49.4067 53.5C49.4067 53.9867 49.2934 54.4267 49.0667 54.82C48.8401 55.2133 48.5334 55.5267 48.1467 55.76C47.7601 55.9867 47.3267 56.1 46.8467 56.1ZM46.8467 55.44C47.1867 55.44 47.4934 55.3533 47.7667 55.18C48.0467 55.0067 48.2667 54.7733 48.4267 54.48C48.5934 54.1867 48.6767 53.86 48.6767 53.5C48.6767 53.1333 48.5934 52.8067 48.4267 52.52C48.2667 52.2267 48.0467 51.9933 47.7667 51.82C47.4934 51.6467 47.1867 51.56 46.8467 51.56C46.5067 51.56 46.1967 51.6467 45.9167 51.82C45.6434 51.9933 45.4234 52.2267 45.2567 52.52C45.0967 52.8067 45.0167 53.1333 45.0167 53.5C45.0167 53.86 45.0967 54.1867 45.2567 54.48C45.4234 54.7733 45.6434 55.0067 45.9167 55.18C46.1967 55.3533 46.5067 55.44 46.8467 55.44ZM50.4347 58.04V50.99H51.1647V51.53C51.598 51.1167 52.138 50.91 52.7847 50.91C53.258 50.91 53.6847 51.0267 54.0647 51.26C54.4447 51.4867 54.7447 51.7933 54.9647 52.18C55.1914 52.5667 55.3047 53.0033 55.3047 53.49C55.3047 53.9767 55.1914 54.4167 54.9647 54.81C54.7447 55.1967 54.4447 55.5067 54.0647 55.74C53.6847 55.9667 53.2547 56.08 52.7747 56.08C52.4814 56.08 52.198 56.03 51.9247 55.93C51.6514 55.83 51.4014 55.6867 51.1747 55.5V58.04H50.4347ZM52.7147 55.43C53.068 55.43 53.3847 55.3467 53.6647 55.18C53.9447 55.0067 54.1647 54.7767 54.3247 54.49C54.4914 54.1967 54.5747 53.8667 54.5747 53.5C54.5747 53.1333 54.4914 52.8033 54.3247 52.51C54.1647 52.2167 53.9447 51.9867 53.6647 51.82C53.3847 51.6467 53.068 51.56 52.7147 51.56C52.4014 51.56 52.108 51.6233 51.8347 51.75C51.568 51.87 51.348 52.04 51.1747 52.26V54.74C51.348 54.9533 51.5714 55.1233 51.8447 55.25C52.118 55.37 52.408 55.43 52.7147 55.43ZM56.3331 56V50.99H57.0731V51.54C57.4531 51.1067 57.9431 50.89 58.5431 50.89C58.8965 50.89 59.2098 50.9733 59.4831 51.14C59.7565 51.3 59.9698 51.52 60.1231 51.8C60.3298 51.4933 60.5765 51.2667 60.8631 51.12C61.1498 50.9667 61.4765 50.89 61.8431 50.89C62.2098 50.89 62.5298 50.9733 62.8031 51.14C63.0765 51.3 63.2898 51.5267 63.4431 51.82C63.6031 52.1067 63.6831 52.4433 63.6831 52.83V56H62.9531V52.98C62.9531 52.5333 62.8365 52.1833 62.6031 51.93C62.3698 51.67 62.0531 51.54 61.6531 51.54C61.3798 51.54 61.1298 51.61 60.9031 51.75C60.6765 51.8833 60.4831 52.0867 60.3231 52.36C60.3365 52.4333 60.3465 52.51 60.3531 52.59C60.3665 52.6633 60.3731 52.7433 60.3731 52.83V56H59.6431V52.98C59.6431 52.5333 59.5265 52.1833 59.2931 51.93C59.0598 51.67 58.7465 51.54 58.3531 51.54C58.0865 51.54 57.8431 51.6033 57.6231 51.73C57.4098 51.85 57.2265 52.03 57.0731 52.27V56H56.3331ZM67.2769 56.09C66.7969 56.09 66.3602 55.9767 65.9669 55.75C65.5802 55.5167 65.2702 55.2033 65.0369 54.81C64.8102 54.4167 64.6969 53.9767 64.6969 53.49C64.6969 53.01 64.8069 52.5767 65.0269 52.19C65.2469 51.7967 65.5435 51.4867 65.9169 51.26C66.2902 51.0267 66.7069 50.91 67.1669 50.91C67.6135 50.91 68.0135 51.0267 68.3669 51.26C68.7269 51.4867 69.0102 51.7967 69.2169 52.19C69.4302 52.5767 69.5369 53.01 69.5369 53.49V53.72H65.4269C65.4669 54.0467 65.5702 54.34 65.7369 54.6C65.9102 54.86 66.1335 55.0667 66.4069 55.22C66.6802 55.3667 66.9802 55.44 67.3069 55.44C67.5669 55.44 67.8202 55.4 68.0669 55.32C68.3135 55.24 68.5202 55.1267 68.6869 54.98L69.1469 55.47C68.8669 55.6767 68.5735 55.8333 68.2669 55.94C67.9669 56.04 67.6369 56.09 67.2769 56.09ZM65.4469 53.13H68.7969C68.7569 52.83 68.6569 52.5633 68.4969 52.33C68.3435 52.09 68.1502 51.9033 67.9169 51.77C67.6835 51.63 67.4269 51.56 67.1469 51.56C66.8602 51.56 66.5969 51.6267 66.3569 51.76C66.1169 51.8933 65.9169 52.08 65.7569 52.32C65.5969 52.5533 65.4935 52.8233 65.4469 53.13ZM70.5714 56V50.99H71.3114V51.58C71.7047 51.12 72.2314 50.89 72.8914 50.89C73.2714 50.89 73.6047 50.9733 73.8914 51.14C74.1847 51.3 74.4114 51.5267 74.5714 51.82C74.7381 52.1067 74.8214 52.4433 74.8214 52.83V56H74.0914V52.98C74.0914 52.5333 73.9647 52.1833 73.7114 51.93C73.4647 51.67 73.1247 51.54 72.6914 51.54C72.3914 51.54 72.1247 51.6067 71.8914 51.74C71.6581 51.8733 71.4647 52.0633 71.3114 52.31V56H70.5714ZM77.8832 56.1C77.4499 56.1 77.1165 55.9967 76.8832 55.79C76.6499 55.5833 76.5332 55.2833 76.5332 54.89V51.62H75.4532V50.99H76.5332V49.72L77.2632 49.53V50.99H78.7732V51.62H77.2632V54.7C77.2632 54.9667 77.3232 55.16 77.4432 55.28C77.5632 55.3933 77.7599 55.45 78.0332 55.45C78.1732 55.45 78.2965 55.44 78.4032 55.42C78.5165 55.4 78.6365 55.3667 78.7632 55.32V55.97C78.6365 56.0167 78.4932 56.05 78.3332 56.07C78.1799 56.09 78.0299 56.1 77.8832 56.1ZM80.1855 56.06C80.0455 56.06 79.9255 56.01 79.8255 55.91C79.7255 55.81 79.6755 55.69 79.6755 55.55C79.6755 55.41 79.7255 55.29 79.8255 55.19C79.9255 55.09 80.0455 55.04 80.1855 55.04C80.3255 55.04 80.4455 55.09 80.5455 55.19C80.6455 55.29 80.6955 55.41 80.6955 55.55C80.6955 55.69 80.6455 55.81 80.5455 55.91C80.4455 56.01 80.3255 56.06 80.1855 56.06ZM80.1855 51.9C80.0455 51.9 79.9255 51.85 79.8255 51.75C79.7255 51.65 79.6755 51.53 79.6755 51.39C79.6755 51.25 79.7255 51.13 79.8255 51.03C79.9255 50.93 80.0455 50.88 80.1855 50.88C80.3255 50.88 80.4455 50.93 80.5455 51.03C80.6455 51.13 80.6955 51.25 80.6955 51.39C80.6955 51.53 80.6455 51.65 80.5455 51.75C80.4455 51.85 80.3255 51.9 80.1855 51.9Z" fill="#718FAA"/>
            <path d="M7 42L93 42" stroke="#102537" stroke-width="0.6"/>
          </svg>
        </a>
      </li>
      <li class="footer-saul">
        <a href="https://saul-design-portfolio-2024.framer.website/" aria-label="Saul's Design Portfolio" target="_blank" rel="noopener">
          <svg width="100" height="64" viewBox="0 0 100 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="100" height="64" rx="4" fill="#22374A"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8095 31.1677C22.8489 31.6452 24.0927 31.884 25.541 31.884C27.5856 31.884 29.1957 31.4229 30.3714 30.5007C31.547 29.5785 32.1349 28.3105 32.1349 26.6967C32.1349 25.7909 31.9815 25.0334 31.6748 24.4241C31.3681 23.7983 30.9592 23.2878 30.448 22.8926C29.9539 22.4974 29.4002 22.1763 28.7868 21.9292C28.1904 21.6822 27.5856 21.4599 26.9722 21.2623C26.3758 21.0647 25.8221 20.8588 25.3109 20.6448C24.8168 20.4307 24.4164 20.1754 24.1097 19.879C23.803 19.5826 23.6497 19.1956 23.6497 18.718C23.6497 18.1581 23.8797 17.7299 24.3397 17.4335C24.7998 17.1371 25.4302 16.9889 26.231 16.9889C26.9296 16.9889 27.4825 17.0835 28.2227 17.3918C28.8046 17.6342 29.4915 18.0085 30.1259 18.5224L31.3947 15.8501C30.866 15.3362 30.4067 15.0278 29.6046 14.6669C28.6164 14.2223 27.5089 14 26.2821 14C25.1235 14 24.0842 14.1976 23.1641 14.5928C22.244 14.9881 21.5199 15.5562 20.9917 16.2973C20.4635 17.0383 20.1994 17.9358 20.1994 18.9897C20.1994 19.879 20.3527 20.62 20.6594 21.2129C20.9661 21.7893 21.3665 22.2668 21.8606 22.6456C22.3718 23.0079 22.9255 23.3125 23.5219 23.5595C24.1353 23.8066 24.7401 24.0289 25.3365 24.2265C25.9499 24.4076 26.5036 24.6135 26.9978 24.844C27.5089 25.0746 27.9178 25.3545 28.2245 25.6839C28.5312 26.0133 28.6846 26.4414 28.6846 26.9684C28.6846 27.5777 28.412 28.0553 27.8667 28.4011C27.3385 28.7469 26.6229 28.9198 25.7199 28.9198C24.7146 28.9198 23.8627 28.7387 23.1641 28.3764C22.4707 28.0004 21.8612 27.4785 21.3357 26.8105L20 29.9903C20.5665 30.4763 21.1696 30.8688 21.8095 31.1677ZM33.4037 31.8018L40.6159 14.4111H43.4447L50.6315 31.8018H46.9361L45.6748 28.5611H45.6651L44.5729 25.741H44.5771L43.7329 23.572L43.1309 22.0176L43.1284 22.0189L42.0133 19.1538L39.414 25.741H39.4152L38.3025 28.5611H38.3012L37.0225 31.8018H33.4037ZM69.7765 31.8018V14.4111H73.3182V28.8085H80.35V31.8018H73.3182H72.3805H69.7765ZM59.11 31.884C57.6961 31.884 56.4353 31.5899 55.328 31.0018C54.2377 30.3973 53.3774 29.5723 52.747 28.5267C52.1166 27.4811 51.8016 26.2966 51.8016 24.9733V14.4111H55.2768V25.741L59.0932 31.0018L62.8921 25.741V14.4111H66.393V24.9978C66.393 26.3211 66.0779 27.5056 65.4475 28.5512C64.8171 29.5804 63.9568 30.3973 62.8665 31.0018C61.7933 31.5899 60.5412 31.884 59.11 31.884ZM80.301 16.0872C80.301 16.9 79.6421 17.559 78.8292 17.559C78.0163 17.559 77.3573 16.9 77.3573 16.0872C77.3573 15.2743 78.0163 14.6153 78.8292 14.6153C79.6421 14.6153 80.301 15.2743 80.301 16.0872ZM80.6132 16.0872C80.6132 17.0725 79.8145 17.8712 78.8292 17.8712C77.8439 17.8712 77.0451 17.0725 77.0451 16.0872C77.0451 15.1018 77.8439 14.3031 78.8292 14.3031C79.8145 14.3031 80.6132 15.1018 80.6132 16.0872ZM78.7422 16.304H78.5212V16.9794H78.1593V15.1953H78.374H78.5212H78.8217C78.9771 15.1953 79.1121 15.2183 79.2266 15.2641C79.3431 15.31 79.4331 15.3746 79.4964 15.4578C79.5598 15.5394 79.5915 15.6362 79.5915 15.7484C79.5915 15.8605 79.5598 15.9582 79.4964 16.0415C79.4331 16.1247 79.3431 16.1893 79.2266 16.2352C79.1914 16.2493 79.1544 16.2612 79.1154 16.2709L79.7203 16.9794H79.2848L78.7422 16.304ZM78.5212 15.4553H78.8064C78.8882 15.4553 78.9597 15.4672 79.0211 15.491C79.0845 15.5148 79.1335 15.5487 79.1683 15.5929C79.203 15.6371 79.2204 15.6915 79.2204 15.756C79.2204 15.8189 79.203 15.8733 79.1683 15.9191C79.1335 15.9633 79.0845 15.9973 79.0211 16.0211C78.9597 16.0449 78.8882 16.0568 78.8064 16.0568H78.5212V15.4553Z" fill="white"/>
            <path opacity="0.8" d="M26.3424 56L24.8324 49H25.6124L26.8024 54.78L28.5324 49H29.2824L31.0124 54.76L32.2124 49H32.9624L31.4524 56H30.6724L28.9024 50.07L27.1224 56H26.3424ZM35.8316 56.09C35.3516 56.09 34.9149 55.9767 34.5216 55.75C34.1349 55.5167 33.8249 55.2033 33.5916 54.81C33.3649 54.4167 33.2516 53.9767 33.2516 53.49C33.2516 53.01 33.3616 52.5767 33.5816 52.19C33.8016 51.7967 34.0982 51.4867 34.4716 51.26C34.8449 51.0267 35.2616 50.91 35.7216 50.91C36.1682 50.91 36.5682 51.0267 36.9216 51.26C37.2816 51.4867 37.5649 51.7967 37.7716 52.19C37.9849 52.5767 38.0916 53.01 38.0916 53.49V53.72H33.9816C34.0216 54.0467 34.1249 54.34 34.2916 54.6C34.4649 54.86 34.6882 55.0667 34.9616 55.22C35.2349 55.3667 35.5349 55.44 35.8616 55.44C36.1216 55.44 36.3749 55.4 36.6216 55.32C36.8682 55.24 37.0749 55.1267 37.2416 54.98L37.7016 55.47C37.4216 55.6767 37.1282 55.8333 36.8216 55.94C36.5216 56.04 36.1916 56.09 35.8316 56.09ZM34.0016 53.13H37.3516C37.3116 52.83 37.2116 52.5633 37.0516 52.33C36.8982 52.09 36.7049 51.9033 36.4716 51.77C36.2382 51.63 35.9816 51.56 35.7016 51.56C35.4149 51.56 35.1516 51.6267 34.9116 51.76C34.6716 51.8933 34.4716 52.08 34.3116 52.32C34.1516 52.5533 34.0482 52.8233 34.0016 53.13ZM39.1261 56V49L39.8661 48.83V51.52C40.2928 51.1133 40.8294 50.91 41.4761 50.91C41.9494 50.91 42.3761 51.0267 42.7561 51.26C43.1361 51.4867 43.4361 51.7933 43.6561 52.18C43.8828 52.5667 43.9961 53.0033 43.9961 53.49C43.9961 53.9767 43.8828 54.4167 43.6561 54.81C43.4361 55.1967 43.1361 55.5067 42.7561 55.74C42.3761 55.9667 41.9461 56.08 41.4661 56.08C41.1728 56.08 40.8861 56.03 40.6061 55.93C40.3328 55.83 40.0828 55.6867 39.8561 55.5V56H39.1261ZM41.4061 55.43C41.7594 55.43 42.0761 55.3467 42.3561 55.18C42.6361 55.0067 42.8561 54.7767 43.0161 54.49C43.1828 54.1967 43.2661 53.8667 43.2661 53.5C43.2661 53.1333 43.1828 52.8033 43.0161 52.51C42.8561 52.2167 42.6361 51.9867 42.3561 51.82C42.0761 51.6467 41.7594 51.56 41.4061 51.56C41.0928 51.56 40.7994 51.6233 40.5261 51.75C40.2594 51.87 40.0394 52.04 39.8661 52.26V54.74C40.0394 54.9533 40.2628 55.1233 40.5361 55.25C40.8094 55.37 41.0994 55.43 41.4061 55.43ZM48.083 55.3H49.663C50.0696 55.3 50.4463 55.23 50.793 55.09C51.1396 54.95 51.443 54.7533 51.703 54.5C51.963 54.2467 52.163 53.95 52.303 53.61C52.4496 53.27 52.523 52.9 52.523 52.5C52.523 52.1 52.4496 51.73 52.303 51.39C52.163 51.05 51.963 50.7533 51.703 50.5C51.443 50.2467 51.1396 50.05 50.793 49.91C50.4463 49.77 50.0696 49.7 49.663 49.7H48.083V55.3ZM47.313 56V49H49.623C50.1563 49 50.6463 49.0867 51.093 49.26C51.5396 49.4333 51.9263 49.6767 52.253 49.99C52.5863 50.3033 52.843 50.6733 53.023 51.1C53.2096 51.5267 53.303 51.9933 53.303 52.5C53.303 53.0067 53.213 53.4733 53.033 53.9C52.853 54.3267 52.5963 54.6967 52.263 55.01C51.9363 55.3233 51.5463 55.5667 51.093 55.74C50.6463 55.9133 50.1563 56 49.623 56H47.313ZM54.3702 56V50.99H55.1102V56H54.3702ZM54.7402 50.03C54.6069 50.03 54.4902 49.98 54.3902 49.88C54.2902 49.78 54.2402 49.6633 54.2402 49.53C54.2402 49.39 54.2902 49.2733 54.3902 49.18C54.4902 49.08 54.6069 49.03 54.7402 49.03C54.8802 49.03 54.9969 49.08 55.0902 49.18C55.1902 49.2733 55.2402 49.39 55.2402 49.53C55.2402 49.6633 55.1902 49.78 55.0902 49.88C54.9969 49.98 54.8802 50.03 54.7402 50.03ZM56.0522 56V55.42L59.0722 51.65H56.0822V50.99H59.9722V51.56L56.9422 55.34H60.0022V56H56.0522ZM62.5811 56.09C62.2144 56.09 61.8911 56.0267 61.6111 55.9C61.3378 55.7733 61.1211 55.5967 60.9611 55.37C60.8078 55.1433 60.7311 54.88 60.7311 54.58C60.7311 54.1067 60.9111 53.7333 61.2711 53.46C61.6311 53.1867 62.1178 53.05 62.7311 53.05C63.2711 53.05 63.7611 53.1633 64.2011 53.39V52.73C64.2011 52.33 64.0878 52.03 63.8611 51.83C63.6344 51.6233 63.3044 51.52 62.8711 51.52C62.6244 51.52 62.3744 51.5567 62.1211 51.63C61.8744 51.6967 61.6011 51.8067 61.3011 51.96L61.0211 51.39C61.3811 51.2167 61.7144 51.09 62.0211 51.01C62.3278 50.93 62.6344 50.89 62.9411 50.89C63.5744 50.89 64.0611 51.04 64.4011 51.34C64.7478 51.64 64.9211 52.07 64.9211 52.63V56H64.2011V55.51C63.9744 55.7033 63.7244 55.85 63.4511 55.95C63.1844 56.0433 62.8944 56.09 62.5811 56.09ZM61.4411 54.56C61.4411 54.84 61.5578 55.07 61.7911 55.25C62.0311 55.4233 62.3378 55.51 62.7111 55.51C63.0111 55.51 63.2844 55.4633 63.5311 55.37C63.7778 55.2767 64.0011 55.13 64.2011 54.93V53.99C63.9944 53.85 63.7744 53.75 63.5411 53.69C63.3078 53.6233 63.0444 53.59 62.7511 53.59C62.3511 53.59 62.0311 53.68 61.7911 53.86C61.5578 54.0333 61.4411 54.2667 61.4411 54.56ZM66.5273 50.03C66.394 50.03 66.2773 49.98 66.1773 49.88C66.0773 49.78 66.0273 49.6633 66.0273 49.53C66.0273 49.39 66.0773 49.2733 66.1773 49.18C66.2773 49.08 66.394 49.03 66.5273 49.03C66.6673 49.03 66.784 49.08 66.8773 49.18C66.9773 49.2733 67.0273 49.39 67.0273 49.53C67.0273 49.6633 66.9773 49.78 66.8773 49.88C66.784 49.98 66.6673 50.03 66.5273 50.03ZM65.6073 58.14C65.514 58.14 65.4273 58.1333 65.3473 58.12C65.2673 58.1067 65.2007 58.0933 65.1473 58.08V57.46C65.254 57.4867 65.3773 57.5 65.5173 57.5C65.7507 57.5 65.914 57.4467 66.0073 57.34C66.1073 57.2333 66.1573 57.06 66.1573 56.82V50.99H66.8973V56.88C66.8973 57.2867 66.784 57.5967 66.5573 57.81C66.3373 58.03 66.0207 58.14 65.6073 58.14ZM68.1593 56V50.99H68.8993V51.58C69.2926 51.12 69.8193 50.89 70.4793 50.89C70.8593 50.89 71.1926 50.9733 71.4793 51.14C71.7726 51.3 71.9993 51.5267 72.1593 51.82C72.326 52.1067 72.4093 52.4433 72.4093 52.83V56H71.6793V52.98C71.6793 52.5333 71.5526 52.1833 71.2993 51.93C71.0526 51.67 70.7126 51.54 70.2793 51.54C69.9793 51.54 69.7126 51.6067 69.4793 51.74C69.246 51.8733 69.0526 52.0633 68.8993 52.31V56H68.1593ZM74.2676 56.06C74.1276 56.06 74.0076 56.01 73.9076 55.91C73.8076 55.81 73.7576 55.69 73.7576 55.55C73.7576 55.41 73.8076 55.29 73.9076 55.19C74.0076 55.09 74.1276 55.04 74.2676 55.04C74.4076 55.04 74.5276 55.09 74.6276 55.19C74.7276 55.29 74.7776 55.41 74.7776 55.55C74.7776 55.69 74.7276 55.81 74.6276 55.91C74.5276 56.01 74.4076 56.06 74.2676 56.06ZM74.2676 51.9C74.1276 51.9 74.0076 51.85 73.9076 51.75C73.8076 51.65 73.7576 51.53 73.7576 51.39C73.7576 51.25 73.8076 51.13 73.9076 51.03C74.0076 50.93 74.1276 50.88 74.2676 50.88C74.4076 50.88 74.5276 50.93 74.6276 51.03C74.7276 51.13 74.7776 51.25 74.7776 51.39C74.7776 51.53 74.7276 51.65 74.6276 51.75C74.5276 51.85 74.4076 51.9 74.2676 51.9Z" fill="#718FAA"/>
            <path d="M7 42L93 42" stroke="#102537" stroke-width="0.6"/>
          </svg>            
        </a>
      </li>
    </ul>
    <div class="footer-info">
      <p class="footer-par">Copyright © 2024 preporukazafilm.com. Sva prava zadržana</p>
      <a class="footer-link" href="{{ home_url() }}/privacy-policy">Pravila Korišćenja</a>
    </div>
  </div>
</footer>
