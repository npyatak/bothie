<?php

use yii\db\Migration;

class m170913_153031_create_table_code extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%code}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'body' => $this->text(),          
        ], $tableOptions);

        $this->batchInsert('{{%code}}', ['name', 'body'], [
            [
                'GA',
                "<script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                    ga('create', 'UA-106401721-1', 'auto');
                    ga('send', 'pageview');
                </script>"
            ],
            [
                'Яндекс метрика',
                '<!-- Yandex.Metrika counter -->
                <script type="text/javascript" >
                (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                try {
                w.yaCounter45939705 = new Ya.Metrika({
                id:45939705,
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
                });
                } catch(e) { }
                });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () { n.parentNode.insertBefore(s, n); };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else { f(); }
                })(document, window, "yandex_metrika_callbacks");
                </script>
                <noscript><div><img src="https://mc.yandex.ru/watch/45939705" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                <!-- /Yandex.Metrika counter -->'
            ],
            [
                'Счетчик',
                '<img src="http://r.mail.ru/r/4166?btype=show&gpmddealid=21924799&puid1=61&puid2=1&%random%" style="width:0;height:0;position:absolute;visibility:hidden;" alt=""/>'
            ],
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%code}}');
    }
}
