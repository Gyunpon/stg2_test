//<![CDATA[
$(document).ready(function(){

  var uaInfo = UAChk();


  //slider
  $('.content_mv_wrap').not('.slick-initialized').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots:true,
    autoplaySpeed: 5000, /* 2021/04/07 黒澤 追加 */
    appendArrows: $('.arrows'),
  });


  $('.agenda_slick .slider_agenda').not('.slick-initialized').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows:false,
    variableWidth:true,
    responsive: [
      {
        breakpoint: 1197,
        settings: {
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: false,
          dots:true,
          variableWidth: true,
                    centerMode: false,
        }
      }
//      ,{
//        breakpoint: 767,
//        settings: {
//          infinite: true,
//          slidesToShow: 1,
//          slidesToScroll: 1,
//          autoplay: false,
//          dots:true,
//                    variableWidth: false,
//          //          centerMode: true,
//        }
//      }
    ]
  });

});
//]]>
