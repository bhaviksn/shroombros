<?php
  global $popup_buttons, $default_popup_config;
?>
<div class="mobile-cont <?php echo $default_popup_config['hide_on_mobile'] ? 'hide_on_mobile' : '';?>">
  <img class="mobile-cont__mobile" src="<?php echo get_template_directory_uri(  );?>/images/mobile.png" alt="" />
  <div class="mobile-cont__click">
    <img class="mobile-cont__close-img" src="<?php echo get_template_directory_uri(  );?>/images/close.png" alt="" />
    <img class="mobile-cont__open-img" src="<?php echo get_template_directory_uri(  );?>/images/click.png" alt="" />
  </div>

  <div class="mobile-cont__img-cont">
    <?php if($default_popup_config['default_image']) { ?>
    <img src="<?php echo $default_popup_config['default_image']['url'];?>" alt="Phone screen"
      class="mobile-cont__img active">
    <?php }?>
    <?php foreach($popup_buttons as $button) { ?>
    <?php if($button['image__video']) {?>
    <iframe width="304" height="355" src="https://www.youtube.com/embed/<?php echo $button['youtube_video_id'];?>"
      title="YouTube video player" frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      allowfullscreen class="mobile-cont__img <?php echo $button['name'];?>"></iframe>
    <?php } else { ?>
    <img src="<?php echo $button['screen_image'];?>" alt="Phone screen"
      class="mobile-cont__img <?php echo $button['name'];?>" />
    <?php }?>
    <?php }?>
  </div>
  <ul class="mobile-cont__links">
    <?php foreach($popup_buttons as $button) { ?>
    <li class="mobile-cont__item">
      <a href="<?php echo $button['page_url']['url'];?>" data-img="<?php echo $button['name'];?>"
        aria-label="<?php echo $button['page_url']['title'];?>"
        data-if-video="<?php if($button['image__video']==1){ ?>true<?php } else { ?>false<?php }?>"
        target="<?php echo $button['page_url']['target'];?>" class="mobile-cont__link">
        <img src="<?php echo $button['icon']['url'];?>" class="mobile-cont__link-icon"
          alt="<?php echo $button['icon']['alt'];?>" />
      </a>
    </li>
    <?php }?>
  </ul>
</div>