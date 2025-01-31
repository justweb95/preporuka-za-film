{{--
  Template Name: Contact Page Template
--}}

@extends('layouts.app')

@section('content')
  <section class="contact-page">
    <div class="contact-page-holder container">
      <div class="contact-page-content">
        <h3>Imate pitanja ili sugestije?</h3>
        <h1>Kontaktirajte nas!</h1>
        <p>
          Uvek smo tu da vam pomognemo! Ako imate bilo kakva pitanja, komentare ili sugestije, slobodno nas kontaktirajte putem forme. 
          Vaše mišljenje nam je važno, i želimo da čujemo šta imate da kažete. 
          Naš tim je posvećen pružanju najboljih odgovora i rešenja za vas, 
          i potrudićemo se da vam odgovorimo u najkraćem mogućem roku. 
        </p>
        
      </div>
      <div class="contact-page-form">
        {!! do_shortcode('[contact-form-7 id="d61b275" title="Contact form"]') !!}
      </div>
    </div>
  </section>
@endsection
