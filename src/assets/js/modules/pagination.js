import $ from 'jquery';

document.addEventListener('DOMContentLoaded', () => {
	let isLoaded = false;
	function paginationInit() {
		const $postsWrapper = document.querySelector('.posts_wrapper');
		const $newsPostsWrapper = document.querySelector('.news_posts_wrapper');
		const $paginationWrapper = document.querySelector('.pagination__wrapper');
		if (!$paginationWrapper || (!$postsWrapper && !$newsPostsWrapper)) return;
		const $paginationItems = $paginationWrapper.querySelectorAll('.pagination_item');

		let postType = $paginationWrapper.dataset.postType ? $paginationWrapper.dataset.postType : '';
		let postTaxonomy = $paginationWrapper.dataset.taxonomy ? $paginationWrapper.dataset.taxonomy : '';
		let maxCountPosts = $paginationWrapper.dataset.maxCountPosts ? $paginationWrapper.dataset.maxCountPosts : '';

		$paginationItems.forEach(item => {
			item.addEventListener('click', (e) => {
				e.preventDefault();
				let pageNum = item.dataset.page;
				let isCurrentPage = item.classList.contains('current');

				if (!isCurrentPage && !isLoaded) {
					isLoaded = true;
					$paginationItems.forEach(itm => itm.classList.remove('current'));
					item.classList.add('current');
					paginationFetch({pageNum, postType, postTaxonomy, maxCountPosts});
				}

			})
		})
	}
	
	function paginationFetch({pageNum = 1, postType, postTaxonomy, maxCountPosts}) {
		const $postsWrapper = document.querySelector('.posts_wrapper');
		const $newsPostsWrapper = document.querySelector('.news_posts_wrapper');
		const $paginationWrapper = document.querySelector('.pagination__wrapper');
		if (!$paginationWrapper || (!$postsWrapper && !$newsPostsWrapper)) return;

		const data = {
			'action': 'get_posts_pagination',
			'page': pageNum,
			'post_type': postType,
			'taxonomy': postTaxonomy,
			'max_count_posts': maxCountPosts
		};

		$.ajax({
			type: 'POST',
			url: window.ajaxData.ajaxurl,
			data: data,
			success: function(response) {
				let data = JSON.parse(response);
				let paginationHtml = data.pagination_html ? data.pagination_html : '';
				let postsHtml = data.posts_html ? data.posts_html : '';

				if ($newsPostsWrapper) {
					$paginationWrapper.remove();
					$newsPostsWrapper.insertAdjacentHTML('afterend', `${paginationHtml}`);
					$newsPostsWrapper.innerHTML = `${postsHtml}`;
				} else if ($postsWrapper) {
					$paginationWrapper.remove();
					$postsWrapper.insertAdjacentHTML('afterend', `${paginationHtml}`);
					$postsWrapper.innerHTML = `${postsHtml}`;
				}

				isLoaded = false;
				paginationInit();
			}
		});
	}

	paginationInit();
})