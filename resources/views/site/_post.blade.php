<div id="gallery" class="isotope-items-wrap lightgallery gsi-color post-container" style="position: relative; height: 1294.38px;">
	<!-- Grid sizer (do not remove!!!) -->
	<div class="grid-sizer"></div>

	@foreach($posts as $post)

	<div class="isotope-item" style="margin: 10px;">
		<div class="row">
			<div class="col-md-12">
				<div class="profile-container" style="display: table-cell; vertical-align: middle;">
					<img src="{{ $post->userDetail->profile_image_url }}" alt="img">
				</div>
				<div style="display: table-cell; vertical-align: middle;">
					<div style="font-size: 18px; letter-spacing: 2px; font-weight: 600;">
						{{ isset($post->user->name) ? $post->user->name : '-' }}
					</div>
					<div style="font-size: 12px; margin-top: -5px;">
						{{ isset($post->user->tagname) ? '@'.$post->user->tagname : '-' }}
					</div>
				</div>
			</div>


			<!-- <div class="col-md-12">
				<div class="profile-container">
					<img src="{{ $post->userDetail->profile_image_url }}" alt="img">
					<span class="profile-">{{ isset($post->user->name) ? $post->user->name : '-' }}</span>
					<span> {{ isset($post->user->tagname) ? '@'.$post->user->tagname : '-' }} </span>
				</div>
			</div> -->

		</div>
		@if($post->video != null)
		<video width="100%" height="100%" poster="{{ App\Helper\FileHelper::url($post->image) }}" controls>
			<source src="{{ App\Helper\FileHelper::url($post->video) }}">
		</video>
		@else
		<a href="{{ App\Helper\FileHelper::url($post->image) }}" class="gallery-single-item lg-trigger" data-exthumbnail="{{ asset('assets/img/gallery/gallery-single/grid/thumb/gallery-single-thumb-1.jpg') }}" data-sub-html="<p>{{ isset($post->decription) ? $post->decription : '-' }}</p>">
			<img src="{{ App\Helper\FileHelper::url($post->image) }}" class="gs-item-image" alt="">

			<div class="gsi-image-caption">{{ isset($post->decription) ? $post->decription : '-' }}</div>
			<div class="gs-item-icon"><i class="fas fa-search"></i></div>
		</a>
		<div class="row">
			<div class="col-md-6">
				<div class="like-container">
					<img src="{{ asset('assets/img/icon-like-1024.png') }}" alt="img"><span class="like">{{ $post->getLikeCount() }}</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="pull-right comment-container">
					<img src="{{ asset('assets/img/icon-comment-1024.png') }}" alt="img"><span class="comment">{{ $post->getCommentCount() }}</span>
				</div>
			</div>
		</div>
		@endif
	</div>

	@endforeach

</div>