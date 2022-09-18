(function ($) {
  $.fn.autoSearch = function () {
    let input = this;
    input.wrap('<div class="searchHolder"></div>');
    input.parent().append('<div class="autoFillBar" id="autoFillBar"></div>');
    let autoFillBar = input.next();
    $('.searchHolder').append('<div id="noresults">');
    $('#noresults').html(
      '<i>Совпадений не найдено <br><br>Попробуйте ввести другой запрос</i>'
    );

    input.on('focus', function () {
      searchCheck();
    });
    input.on('keyup', function () {
      searchCheck();
    });

    $('#exit').on('click', function (e) {
      if (
        !$(e.target).hasClass('autoFillBar') &&
        !$(e.target).parent().hasClass('autoFillBar') &&
        !$(e.target).parent().hasClass('searchHolder')
      ) {
        autoFillBar.slideUp(200, function () {
          autoFillBar.children().remove();
          $('#main').css('display', 'block');
          $('#noresults').css('display', 'none');
          $('#exit').css('display', 'none');
        });
      }

      $('#navi').css('display', 'grid');

      input.val('');
    });

    function searchCheck() {
      if (input.val().length > 2) {
        let data = {};
        data.action = 'search';
        data.request = input.val();
        autoFillBar.children().remove();
        $('#main').css('display', 'none');
        $('#navi').css('display', 'none');
        $('#exit').css('display', 'block');
        $('#noresults').css('display', 'block');
        let articlesArray = [];

        for (let i = 0; i < docs.length; i++) {
          let searchRequestStart = new RegExp('^' + input.val() + '.*', 'i');
          let searchRequestMiddle = new RegExp(' ' + input.val() + '.*', 'i');
          if (
            searchRequestStart.test(docs[i].anno) ||
            searchRequestMiddle.test(docs[i].anno)
          ) {
            articlesArray.push(docs[i]);
          }
        }

        for (let i = 0; i <= articlesArray.length - 1; i++) {
          let name = articlesArray[i].anno;
          let regex = input.val();
          if (regex.indexOf(' ') !== 1) {
            let searchMask = regex;
            let regEx = new RegExp(searchMask, 'ig');
            let num = name.toLowerCase().indexOf(regex.toLowerCase());
            let strname = name.substr(num, regex.length);
            let replaceMask = '<b class="light">' + strname + '</b>';
            name = name.replace(regEx, replaceMask);
            $(window).scrollTop(0);
            $('#main').css('display', 'none');
            $('#navi').css('display', 'none');
            $('#exit').css('display', 'block');
            $('#noresults').css('display', 'none');
          } else {
            let regexArr = regex.split(' ');

            for (let n = 0; n < regexArr.length; n++) {
              if (regexArr[n].length > 0) {
                let searchMask = regexArr[n];
                let regEx = new RegExp(searchMask, 'ig');
                let num = name.toLowerCase().indexOf(regexArr[n].toLowerCase());
                let strname = name.substr(num, regexArr[n].length);
                let replaceMask = '<b class="light">' + strname + '</b>';
                let stopWords = '<b class="light"></b>';

                if (stopWords.indexOf(strname.toLowerCase()) == -1) {
                  name = name.replace(regEx, replaceMask);
                }
              }
            }
          }

          autoFillBar.append(
            $('<div class="item">')
              .attr({
                'data-fancybox': 'newgallery',
                'data-src': 'img/' + articlesArray[i].pict + '',
                'data-caption': '' + articlesArray[i].anno + '',
              })
              .html(
                '<div class="img" style="background-image: url(min/' +
                  articlesArray[i].pict +
                  ')">'
              )
              .append('<div class="anno">' + name + '</div>')
          );
        }
        autoFillBar.slideDown(100);
      } else {
        $('#main').css('display', 'block');
        $('#navi').css('display', 'grid');

        autoFillBar.children().remove();
        $('#exit').css('display', 'none');
        $('#noresults').css('display', 'none');
      }
    }

    return input;
  };
  $(document).ready(function () {
    $('#search').autoSearch();
  });
})(jQuery);
