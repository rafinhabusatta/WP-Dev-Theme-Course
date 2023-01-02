/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/Search.js":
/*!*******************************!*\
  !*** ./src/modules/Search.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
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


class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = jquery__WEBPACK_IMPORTED_MODULE_0___default()('#search-results');
    this.openButton = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.js-search-trigger');
    this.closeButton = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search-overlay_close');
    this.searchOverlay = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search-overlay');
    this.searchField = jquery__WEBPACK_IMPORTED_MODULE_0___default()('#search-term');
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).on('keydown', this.keyPressDispatcher.bind(this));
    this.searchField.on('keyup', this.typingLogic.bind(this));
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html(`
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            `);
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html(`
        <h2></h2>
        `);
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val(); // get the value of the search field
  }

  getResults() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default().when(jquery__WEBPACK_IMPORTED_MODULE_0___default().getJSON(data.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), jquery__WEBPACK_IMPORTED_MODULE_0___default().getJSON(data.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())).then((posts, pages) => {
      let resultadosCombinados = posts[0].concat(pages[0]);
      this.resultsDiv.html(`
        <h2>Informações Gerais</h2>
        ${resultadosCombinados.length ? '<ul class="results-list">' : '<p>Não há resultados</p>'}
          ${resultadosCombinados.map(item => `<li>
                  <a href="${item.link}">
                    ${item.title.rendered}
                  </a>  ${item.type == 'post' ? `by ${item.authorName}` : ''}
                </li>`).join('')}
        ${resultadosCombinados.length ? '</ul>' : ''}
        `);
      this.isSpinnerVisible = false;
    }, () => {
      this.resultsDiv.html('<p>Algo deu errado, por favor tente novamente.</p>');
    });
  }
  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !jquery__WEBPACK_IMPORTED_MODULE_0___default()('input, textarea').is(':focus')) {
      this.openOverlay();
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
  openOverlay() {
    this.searchOverlay.removeClass('d-none');
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').addClass('body-no-scroll');
    this.searchField.val('');
    console.log('our open method just ran!');
    this.isOverlayOpen = true;
    setTimeout(() => this.searchField.focus(), 300);
  }
  closeOverlay() {
    this.searchOverlay.addClass('d-none');
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').removeClass('body-no-scroll');
    console.log('our close method just ran!');
    this.isOverlayOpen = false;
  }
  addSearchHTML() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').append(`
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
    `);
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Search);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["jQuery"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_Search__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/Search */ "./src/modules/Search.js");
//import '../css/style.scss'

// Our modules / classes
//import GoogleMap from './modules/GoogleMap'


// Instantiate a new object using our modules/classes
//const googleMap = new GoogleMap()
const search = new _modules_Search__WEBPACK_IMPORTED_MODULE_0__["default"]();
})();

/******/ })()
;
//# sourceMappingURL=index.js.map