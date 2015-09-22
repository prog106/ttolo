                <li id="view">
                    <div class="fullcomment">
                        <pre><?=$row['mu_comment'];?></pre>
                        <?=((!empty($row['mu_imagesrc']))? '<img src="/static/upload/'.$row['mu_imagesrc'].'">' : '');?>
                    </div>
                </li>
