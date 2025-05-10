<?php
/*
Template Name: Units
*/
/**

 * 
 * @param array $suites 
 * @param string $section_title 
 */

$arg=$_GET['arg']

$conn = new mysqli("5.161.90.110", "root", "exampleqi", "prismpm");
	$res = $conn->query("SELECT * FROM units WHERE unit_status = 1");
	$data = [];

	while ($row = $res->fetch_assoc()) {
	  $data[] = $row;
	}



$buildings=array_unique(array_column($data, 'building_id'));

?>
<section class="full-width-suites">
    <h1><?php echo $arg ?> </h1>
    <h2 class="section-title">UNITS</h2>
    <div class="buildingsFilter">
        <?php foreach ($buildings as $item): ?>
            <a href="/newforrent?arg=<?= esc_html($item) ?>"><?= esc_html($item) ?> </a>
            <?php endforeach ?>
    </div>

    <div class="suites-list">
<?php foreach ($data as $item): ?>
              <div class="suite-item">


                <div class="suite-content">
                    <div class="suite-info">

                        <h3 class="suite-title"><?= esc_html($item['building_id']) ?> - <?= esc_html($item['unit']) ?></h3>

                        <div class="suite-availability">
                            <span class="availability-dot">●</span>
                            <span class="availability-text">Available</span>
                        </div>

                        <div class="suite-tags">

                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.75 4.58325V17.4166M2.75 14.6666H19.25M19.25 17.4166V12.0999C19.25 11.0732 19.25 10.5597 19.0502 10.1676C18.8744 9.82264 18.5939 9.54214 18.249 9.36642C17.8569 9.16659 17.3434 9.16659 16.3167 9.16659H10.0833V14.4166M6.41667 10.9999H6.42583M7.33333 10.9999C7.33333 11.5062 6.92292 11.9166 6.41667 11.9166C5.91041 11.9166 5.5 11.5062 5.5 10.9999C5.5 10.4936 5.91041 10.0833 6.41667 10.0833C6.92292 10.0833 7.33333 10.4936 7.33333 10.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span></span>
                                </div>



                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7572 5.56968C10.5359 5.85004 9.625 6.94364 9.625 8.25V8.9375H15.125V8.25C15.125 7.01287 14.3081 5.96653 13.1842 5.621C13.4001 5.1442 13.8801 4.8125 14.4375 4.8125C15.1969 4.8125 15.8125 5.42811 15.8125 6.1875V11.6875H4.125V13.0625H4.8125V16.5C4.8125 17.6391 5.73591 18.5625 6.875 18.5625H15.125C16.264 18.5625 17.1875 17.6391 17.1875 16.5V13.0625H17.875V11.6875H17.1875V6.1875C17.1875 4.66872 15.9563 3.4375 14.4375 3.4375C13.1312 3.4375 12.0376 4.34839 11.7572 5.56968ZM6.1875 13.0625H15.8125V16.5C15.8125 16.8797 15.5047 17.1875 15.125 17.1875H6.875C6.49531 17.1875 6.1875 16.8797 6.1875 16.5V13.0625ZM12.375 6.875C12.8839 6.875 13.3283 7.15151 13.566 7.5625H11.184C11.4217 7.15151 11.8661 6.875 12.375 6.875Z" fill="black" />
                                    </svg>
                                    <span></span>
                                </div>



                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.33333 2.75H4.58333C4.0971 2.75 3.63079 2.94315 3.28697 3.28697C2.94315 3.63079 2.75 4.0971 2.75 4.58333V7.33333M19.25 7.33333V4.58333C19.25 4.0971 19.0568 3.63079 18.713 3.28697C18.3692 2.94315 17.9029 2.75 17.4167 2.75H14.6667M14.6667 19.25H17.4167C17.9029 19.25 18.3692 19.0568 18.713 18.713C19.0568 18.3692 19.25 17.9029 19.25 17.4167V14.6667M2.75 14.6667V17.4167C2.75 17.9029 2.94315 18.3692 3.28697 18.713C3.63079 19.0568 4.0971 19.25 4.58333 19.25H7.33333" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span></span>
                                </div>



                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.04293 15.3542C3.82293 18.0034 5.82126 20.1667 8.47959 20.1667H12.8704C15.8587 20.1667 17.9121 17.7559 17.4171 14.8042C16.8946 11.7059 13.9062 9.16675 10.7621 9.16675C7.35209 9.16675 4.32709 11.9534 4.04293 15.3542Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.59736 6.87508C10.863 6.87508 11.889 5.84907 11.889 4.58341C11.889 3.31776 10.863 2.29175 9.59736 2.29175C8.33168 2.29175 7.30566 3.31776 7.30566 4.58341C7.30566 5.84907 8.33168 6.87508 9.59736 6.87508Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.8587 7.97502C16.8713 7.97502 17.6921 7.15421 17.6921 6.14168C17.6921 5.12916 16.8713 4.30835 15.8587 4.30835C14.8463 4.30835 14.0254 5.12916 14.0254 6.14168C14.0254 7.15421 14.8463 7.97502 15.8587 7.97502Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M19.25 11.6416C20.0094 11.6416 20.625 11.026 20.625 10.2666C20.625 9.50719 20.0094 8.8916 19.25 8.8916C18.4906 8.8916 17.875 9.50719 17.875 10.2666C17.875 11.026 18.4906 11.6416 19.25 11.6416Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.639 9.80831C4.65152 9.80831 5.47233 8.98746 5.47233 7.97493C5.47233 6.96241 4.65152 6.1416 3.639 6.1416C2.62647 6.1416 1.80566 6.96241 1.80566 7.97493C1.80566 8.98746 2.62647 9.80831 3.639 9.80831Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Pet friendly</span>
                                </div>

                        </div>
                    </div>

                    <div class="suite-price-section">

                            <div class="suite-price">
                                <div class="price-amount"><?= esc_html($item['market_rent']) ?></div>

                                    <div class="price-period">monthly</div>

                            </div>

                        <button class="wishlist">♡</button>
                    </div>
                </div>
            </div>
<?php endforeach; ?>


    </div>
</section>

<style>
    .full-width-suites {
        font-family: "Inter Tight", sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #2A2A2A;
        text-align: center;
    }

    .suites-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .suite-item {
        display: flex;
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        background: white;
        transition: box-shadow 0.2s ease;
        overflow: hidden;
    }

    .suite-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .suite-image {
        width: 300px;
        min-height: 100%;
        flex-shrink: 0;
    }

    .suite-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .suite-content {
        flex: 1;
        display: flex;
        padding: 1.5rem;
        justify-content: space-between;
        background: #093D5F0D;
    }

    .suite-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .suite-title {
        font-size: 1.5rem;
        margin: 0;
        color: #2A2A2A;
        font-weight: 600;
    }

    .suite-availability {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .availability-dot {
        color: #10B981;
        font-size: 1.2rem;
    }

    .availability-text {
        color: #2A2A2A;
        font-weight: 500;
    }

    .suite-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .tag-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        border: 1px solid #e0e0e0;
        font-size: 0.9rem;
    }

    .tag-item svg {
        width: 18px;
        height: 18px;
    }

    .suite-price-section {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
    }

    .suite-price {
        text-align: right;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2A2A2A;
    }

    .price-period {
        color: #6B7280;
        font-size: 0.8rem;
    }

    .wishlist {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #2A2A2A;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    .wishlist:hover {
        color: red;
    }

    @media (max-width: 768px) {
        .suite-item {
            flex-direction: column;
        }

        .suite-image {
            width: 100%;
            height: 200px;
        }

        .suite-content {
            flex-direction: column;
            gap: 1.5rem;
        }

        .suite-price-section {
            flex-direction: row;
            align-items: center;
        }
        
        .suite-price {
            text-align: left;
        }
    }
</style>
<?php