<?php
namespace frontend\widgets\share;

use yii\helpers\Url;

class ShareWidget extends \yii\bootstrap\Widget  {
	
	public $id;
	public $url;
	public $title;
	public $image;
	public $desc;

    public function run() {
    	$script = "
    		Share = {
				vkontakte: function(id, purl, ptitle, pimg, text) {
					url  = 'http://vkontakte.ru/share.php?';
					url += 'url='          + encodeURIComponent(purl);
					url += '&title='       + encodeURIComponent(ptitle);
					url += '&description=' + encodeURIComponent(text);
					url += '&image='       + encodeURIComponent(pimg);
					url += '&noparse=true';
					Share.response(id, 'vk');
					Share.popup(url);
				},
				facebook: function(id, purl, ptitle, pimg, text) {
					url  = 'http://www.facebook.com/sharer.php?s=100';
					url += '&p[title]='     + encodeURIComponent(ptitle);
					url += '&p[summary]='   + encodeURIComponent(text);
					url += '&p[url]='       + encodeURIComponent(purl);
					url += '&p[images][0]=' + encodeURIComponent(pimg);
					Share.response(id, 'fb');
					Share.popup(url);
				},
				popup: function(url) {
					window.open(url,'','toolbar=0,status=0,width=626,height=436');
				},

				response: function(id, type) {
			        $.ajax({
			            type: 'GET',
            			url: '".Url::toRoute(['site/user-action'])."',
			            data: 'id='+id+'&type='+type,
			            success: function (data) {
			                alert(data.score);
			            }
			        });
				}
			};
	    ";
	    $this->view->registerJs($script, $this->view::POS_END);

		echo $this->render('widget', [
			'id' => $this->id,
			'url' => $this->url,
			'title' => $this->title,
			'image' => $this->image,
			'desc' => $this->desc,
		]);
    }
}
?>