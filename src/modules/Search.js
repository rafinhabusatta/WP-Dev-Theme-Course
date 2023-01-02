// class Search {
//   // 1. Describe and create/initiate our object
//   constructor() {
//     this.resultsDiv = document.querySelector('#search-overlay_results')
//     this.openButton = document.querySelector('.js-search-trigger')
//     this.closeButton = document.querySelector('.search-overlay_close')
//     this.searchOverlay = document.querySelector('.search-overlay')
//     this.searchField = document.querySelector('#search-term')
//     this.events()
//     this.isOverlayOpen = false
//   }

//   // 2. Events
//   events() {
//     console.log(this.openButton)
//     console.log(this.closeButton)
//     console.log(this.searchOverlay)
//     console.log(this.searchField)

//     this.openButton.addEventListener('click', () => this.openOverlay())
//     this.closeButton.addEventListener('click', () => this.closeOverlay())
//     document.addEventListener('keydown', () => this.keyPressDispatcher(e))
//     this.searchField.addEventListener('keydown', () => this.typingLogic())
//   }

//   // 3. Methods (function, action...)
//   typingLogic() {
//     clearTimeout(this.typingTimer)
//     this.typingTimer = setTimeout(function () {
//       console.log('timeout test')
//     }, 2000)
//   }
//   openOverlay() {
//     document.querySelector('.search-overlay').classList.remove('d-none')
//     //document.querySelector('.search-overlay').classList.add('d-block')
//     //$('.search-overlay').removeClass('d-none')
//     document.body.classList.add('body-no-scroll')
//     this.isOverlayOpen = true
//     alert('openOverlay')
//   }

//   closeOverlay() {
//     document.querySelector('.search-overlay').classList.add('d-none')
//     //this.searchOverlay.addClass('d-none')
//     document.body.classList.remove('body-no-scroll')
//     this.isOverlayOpen = false
//     alert('closeOverlay')
//   }

//   keyPressDispatcher(e) {
//     if (e.keyCode == 83 && !this.isOverlayOpen) {
//       this.openOverlay()
//     }
//     if (e.keyCode == 27 && this.isOverlayOpen) {
//       this.closeOverlay()
//     }
//   }
// }

// export default Search

import $ from 'jquery'

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML()
    this.resultsDiv = $('#search-results')
    this.openButton = $('.js-search-trigger')
    this.closeButton = $('.search-overlay_close')
    this.searchOverlay = $('.search-overlay')
    this.searchField = $('#search-term')
    this.events()
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
  }

  // 2. events
  events() {
    this.openButton.on('click', this.openOverlay.bind(this))
    this.closeButton.on('click', this.closeOverlay.bind(this))
    $(document).on('keydown', this.keyPressDispatcher.bind(this))
    this.searchField.on('keyup', this.typingLogic.bind(this))
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer)
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html(`
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            `)
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.html(`
        <h2></h2>
        `)
        this.isSpinnerVisible = false
      }
    }
    this.previousValue = this.searchField.val() // get the value of the search field
  }

  getResults() {
    $.when(
      $.getJSON(
        data.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()
      ),
      $.getJSON(
        data.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val()
      )
    ).then(
      (posts, pages) => {
        let resultadosCombinados = posts[0].concat(pages[0])
        this.resultsDiv.html(`
        <h2>Informações Gerais</h2>
        ${
          resultadosCombinados.length
            ? '<ul class="results-list">'
            : '<p>Não há resultados</p>'
        }
          ${resultadosCombinados
            .map(
              item =>
                `<li>
                  <a href="${item.link}">
                    ${item.title.rendered}
                  </a>  ${item.type == 'post' ? `by ${item.authorName}` : ''}
                </li>`
            )
            .join('')}
        ${resultadosCombinados.length ? '</ul>' : ''}
        `)
        this.isSpinnerVisible = false
      },
      () => {
        this.resultsDiv.html(
          '<p>Algo deu errado, por favor tente novamente.</p>'
        )
      }
    )
  }

  keyPressDispatcher(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      !$('input, textarea').is(':focus')
    ) {
      this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    this.searchOverlay.removeClass('d-none')
    $('body').addClass('body-no-scroll')
    this.searchField.val('')
    console.log('our open method just ran!')
    this.isOverlayOpen = true
    setTimeout(() => this.searchField.focus(), 300)
  }

  closeOverlay() {
    this.searchOverlay.addClass('d-none')
    $('body').removeClass('body-no-scroll')
    console.log('our close method just ran!')
    this.isOverlayOpen = false
  }

  addSearchHTML() {
    $('body').append(`
    <div class="container-fluid search-overlay d-none">
      <div class="row mt-5">
        <div class="col-12 d-flex flex-row">
          <input class="form-control me-2 search-term"
            type="search"
            placeholder="What are you looking for?"
            aria-label="Pesquisar" id="search-term"
            autocomplete="off"
          />
          <span class="btn btn-outline-success search-overlay_close" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16" search-overlay_icon>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </span>
        </div>
      </div>
      <div class="row mt-5 text-white">
        <div id="search-results" class="col-12">
          
        </div>
      </div>
    </div>
    `)
  }
}

export default Search
