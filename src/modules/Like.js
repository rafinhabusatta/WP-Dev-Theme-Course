import axios from 'axios'

class Like {
  constructor() {
    if (document.querySelector('.like-box')) {
      this.likeBox = document.querySelector('.like-box')
      axios.defaults.headers.common['X-WP-Nonce'] = data.nonce
      this.events()
    }
  }

  events() {
    this.likeBox.addEventListener('click', e => this.clickDispatcher(e))
  }

  // Methods
  clickDispatcher(e) {
    let currentLikeBox = e.target.closest('.like-box')
    // let currentLikeBox = e.target
    // while (!currentLikeBox.classList.contains('like-box')) {
    //   currentLikeBox = currentLikeBox.parentElement
    // }

    if (currentLikeBox.getAttribute('data-exists') == 'yes') {
      // Call deleteLike
      this.deleteLike(currentLikeBox)
    } else {
      // Call createLike
      this.createLike(currentLikeBox)
    }
  }

  async createLike(currentLikeBox) {
    let professor = {
      professorId: currentLikeBox.getAttribute('data-professor')
    }
    try {
      const response = await axios.post(
        data.root_url + '/wp-json/al-advogados/v1/manageLike',
        professor
      )
      if (response.data != 'Only logged in users can create a like.') {
        currentLikeBox.setAttribute('data-exists', 'yes')
        let likeCount = parseInt(
          currentLikeBox.querySelector('.like-count').innerHTML,
          10
        ) // 10 = base 10
        likeCount++
        currentLikeBox.querySelector('.like-count').innerHTML = likeCount
        currentLikeBox.setAttribute('data-like', response)
      }
      console.log('data', response.data)
    } catch (e) {
      console.log('error', e)
    }
  }

  async deleteLike(currentLikeBox) {
    let like = {
      like: currentLikeBox.getAttribute('data-like')
    }
    try {
      let response = await axios({
        url: data.root_url + '/wp-json/al-advogados/v1/manageLike',
        method: 'delete',
        data: like
      })
      currentLikeBox.setAttribute('data-exists', 'no')
      let likeCount = parseInt(
        currentLikeBox.querySelector('.like-count').innerHTML,
        10
      ) // 10 = base 10
      likeCount--
      currentLikeBox.querySelector('.like-count').innerHTML = likeCount
      currentLikeBox.setAttribute('data-like', '')
      const results = response.data
      console.log('results', results)
    } catch (e) {
      console.log('error', e)
    }
  }
}

export default Like
