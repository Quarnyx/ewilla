<?php
$product_id = $_GET['id'];
$getproduct = "SELECT * FROM v_newpro WHERE product_id = '$_GET[id]'";
$query = mysqli_query($conn, $getproduct);
$data = mysqli_fetch_array($query);

?>

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2><?php echo $data['product_name']; ?></h2>

        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Product Details Area -->
<section class="product-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="products-details-image">
                    <ul class="products-details-image-slides">
                        <?php
                        $getimage = "SELECT * FROM v_imagesingle WHERE product_id = '$_GET[id]' GROUP BY color";
                        $queryimage = mysqli_query($conn, $getimage);
                        while ($dataimage = mysqli_fetch_array($queryimage)) {
                            ?>
                            <li><img src="assets/img/products/<?php echo $dataimage['image_url']; ?>" alt="image"></li>
                        <?php } ?>
                    </ul>

                    <div class="slick-thumbs">
                        <ul>
                            <?php
                            $getimage = "SELECT * FROM v_imagesingle WHERE product_id = '$_GET[id]' GROUP BY color";
                            $queryimage = mysqli_query($conn, $getimage);
                            while ($dataimage = mysqli_fetch_array($queryimage)) {
                                ?>
                                <li><img src="assets/img/products/<?php echo $dataimage['image_url']; ?>" alt="image">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="products-details-desc">
                    <h3><?php echo $data['product_name']; ?></h3>

                    <div class="price">
                        <span class="new-price">Rp
                            <?php echo number_format($data['product_price'], 0, ',', '.'); ?></span>
                    </div>

                    <ul class="products-info">
                        <?php
                        $stok = "SELECT * FROM v_realstock WHERE product_id = $product_id";
                        $querystok = mysqli_query($conn, $stok);
                        $datastok = mysqli_fetch_array($querystok);
                        ?>
                        <li><span>Stok:</span> <a
                                href="#"><?php echo (!isset($datastok['stock_level']) ? 0 : $datastok['stock_level']); ?></a>
                        </li>
                        <li><span>Kategori Produk:</span> <a href="#"><?php echo $data['category_name']; ?></a></li>
                    </ul>
                    <?php
                    $variations_sql = "SELECT * FROM lp_variations WHERE product_id = $product_id";
                    $variations_result = $conn->query($variations_sql);
                    $variations = [];
                    while ($row = $variations_result->fetch_assoc()) {
                        $variations[] = $row;
                    }
                    ?>
                    <div class="products-color-switch">
                        <span>Warna:</span>

                        <select id="color" name="color">
                            <?php
                            $colors = [];
                            foreach ($variations as $variation) {
                                if (!in_array($variation['color'], $colors)) {
                                    $colors[] = $variation['color'];
                                    echo '<option value="' . htmlspecialchars($variation['color']) . '">' . htmlspecialchars($variation['color']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="products-size-wrapper">
                        <span>Ukuran:</span>

                        <select id="size" name="size">
                            <?php
                            $sizes = [];
                            foreach ($variations as $variation) {
                                if (!in_array($variation['size'], $sizes)) {
                                    $sizes[] = $variation['size'];
                                    echo '<option value="' . htmlspecialchars($variation['size']) . '">' . htmlspecialchars($variation['size']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="products-add-to-cart">
                        <div class="input-counter">
                            <span class="minus-btn"><i class='bx bx-minus'></i></span>
                            <input id="product-quantity" type="text" value="1">
                            <span class="plus-btn"><i class='bx bx-plus'></i></span>
                        </div>

                        <button id="addtocart" class="default-btn" <?php if (!isset($datastok['stock_level'])) {
                            echo 'disabled';
                        } ?>><i class="fas fa-cart-plus"></i> Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab products-details-tab">
            <ul class="tabs">
                <li><a href="#">
                        <div class="dot"></div> Deskripsi Produk
                    </a></li>
            </ul>

            <div class="tab-content">
                <div class="tabs-item">
                    <div class="products-details-tab-content">
                        <?php echo htmlspecialchars_decode($data['description']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<!-- End Product Details Area -->



<!-- Start Size Guide Modal Area -->
<div class="modal fade sizeGuideModal" id="sizeGuideModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="bx bx-x"></i></span>
            </button>

            <div class="modal-sizeguide">
                <h3>Panduan Ukuran</h3>
                <p>Tabel ukuran</p>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Italian</th>
                                <th>Spanish</th>
                                <th>German</th>
                                <th>UK</th>
                                <th>US</th>
                                <th>Japanese</th>
                                <th>Chinese</th>
                                <th>Russian</th>
                                <th>Korean</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>34</td>
                                <td>30</td>
                                <td>28</td>
                                <td>4</td>
                                <td>00</td>
                                <td>3</td>
                                <td>155/75A</td>
                                <td>36</td>
                                <td>44</td>
                            </tr>
                            <tr>
                                <td>36</td>
                                <td>32</td>
                                <td>30</td>
                                <td>6</td>
                                <td>0</td>
                                <td>5</td>
                                <td>155/80A</td>
                                <td>38</td>
                                <td>44</td>
                            </tr>
                            <tr>
                                <td>38</td>
                                <td>34</td>
                                <td>32</td>
                                <td>8</td>
                                <td>2</td>
                                <td>7</td>
                                <td>160/84A</td>
                                <td>40</td>
                                <td>55</td>
                            </tr>
                            <tr>
                                <td>40</td>
                                <td>36</td>
                                <td>34</td>
                                <td>10</td>
                                <td>4</td>
                                <td>9</td>
                                <td>165/88A</td>
                                <td>42</td>
                                <td>55</td>
                            </tr>
                            <tr>
                                <td>42</td>
                                <td>38</td>
                                <td>36</td>
                                <td>12</td>
                                <td>6</td>
                                <td>11</td>
                                <td>170/92A</td>
                                <td>44</td>
                                <td>66</td>
                            </tr>
                            <tr>
                                <td>44</td>
                                <td>40</td>
                                <td>38</td>
                                <td>14</td>
                                <td>8</td>
                                <td>13</td>
                                <td>175/96A</td>
                                <td>46</td>
                                <td>66</td>
                            </tr>
                            <tr>
                                <td>46</td>
                                <td>42</td>
                                <td>40</td>
                                <td>16</td>
                                <td>10</td>
                                <td>15</td>
                                <td>170/98A</td>
                                <td>48</td>
                                <td>77</td>
                            </tr>
                            <tr>
                                <td>48</td>
                                <td>44</td>
                                <td>42</td>
                                <td>18</td>
                                <td>12</td>
                                <td>17</td>
                                <td>170/100B</td>
                                <td>50</td>
                                <td>77</td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td>46</td>
                                <td>44</td>
                                <td>20</td>
                                <td>14</td>
                                <td>19</td>
                                <td>175/100B</td>
                                <td>52</td>
                                <td>88</td>
                            </tr>
                            <tr>
                                <td>52</td>
                                <td>48</td>
                                <td>46</td>
                                <td>22</td>
                                <td>16</td>
                                <td>21</td>
                                <td>180/104B</td>
                                <td>54</td>
                                <td>88</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Size Guide Modal Area -->
<script>
    $(document).ready(function () {
        // Handle Add to Cart button click
        $('#addtocart').click(function () {
            var selectedColor = $('#color').val();
            var selectedSize = $('#size').val();
            var productId = <?php echo $product_id; ?>;
            var product_quantity = $('#product-quantity').val();
            var user_id = <?php echo $_SESSION['user_id']; ?>;

            if (selectedColor && selectedSize) {
                $.ajax({
                    url: 'process.php?act=addtocart',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        color: selectedColor,
                        size: selectedSize,
                        quantity: product_quantity,
                        user_id: user_id
                    },
                    success: function (response) {
                        loadCart();
                    }
                });
            } else {
                alert('Please select a color and size.');
            }
        });
    });
</script>