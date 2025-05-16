<!-- snippets/payment-w-usp-snippet.liquid -->
{% assign allowed_payment_types = "visa,master,american_express,paypal,discover,diners_club,apple_pay" | split: "," %}

<div class="payment-w-usp">
  {% if block.settings.content != blank %}
  <div class="payment-w-usp-content center">
    {{ block.settings.content }}
  </div>
  {% endif %}
  <div class="payment-options">
    <ul class="list list-payment" role="list">      
      {%- for type in allowed_payment_types -%}
        {%- if allowed_payment_types contains type -%}
          <li class="list-payment__item">
            {{ type | payment_type_svg_tag: class: 'icon icon--full-color' }}
          </li>
        {%- endif -%}
      {%- endfor -%}
    </ul>
  </div>
  
  <div class="icon-section">
    {% for i in (1..2) %}
    {% assign icon_text_key = 'usp_text_' | append: i %}
    {% assign usp_icon_key = 'usp_icon_' | append: i %}

    {% if block.settings[usp_icon_key] != blank or block.settings[icon_text_key] != blank %}
      <div class="icon-box">
        {% if block.settings[usp_icon_key] != blank %}
        <div class="icon">
          {% render 'icon-accordion', icon: block.settings[usp_icon_key] %}
        </div>
        {% endif %}
        {% if block.settings[icon_text_key] != blank %}
        <span class="icon-text">{{ block.settings[icon_text_key] }}</span>
        {% endif %}
      </div>
      {% endif %}
    {% endfor %}
  </div>
</div>

<style>
  .payment-w-usp .payment-w-usp-content {
      font-size: 10px;
  }
  .payment-w-usp {
      display: flex;
      flex-flow: column;
      gap: 10px;
  }
  .payment-options ul.list.list-payment {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding-top: 0;
  }
  .payment-options ul.list.list-payment li { list-style: none; }
  .payment-w-usp .icon-section {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
  }
  .payment-w-usp .icon-section .icon-box {
      display: flex;
      align-items: center;
      gap: 5px;
  }
  .payment-w-usp .icon-section .icon-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
      background-color: #04a68a;
      padding: 2px 10px;
      border-radius: 20px;
      color: #fff;
  }
  .payment-w-usp .icon-section .icon-box .icon {
      display: inline-flex;
      align-items: center;
  }
  .payment-w-usp .icon-section .icon-box .icon span.svg-wrapper svg {
      border: none !important;
      fill: #fff;
  }
  .payment-w-usp .icon-section .icon-box {
      flex: 1;
  }
  @media(min-width: 1024px){
    .payment-w-usp .icon-section .icon-box {
        font-size: 10px;
        line-height: 12px;
    }
    .payment-w-usp .payment-w-usp-content {
        font-size: 10px;
    }
    .payment-w-usp .icon-section .icon-box .icon span.svg-wrapper {
        width: 16px;
        height: 16px;
    }
  }
  @media(max-width: 1022px){
    .payment-w-usp .icon-section .icon-box {
        font-size: 7px;
        line-height: 12px;
    }
    .payment-w-usp .payment-w-usp-content {
        font-size: 9px;
        line-height: 12px;
    }
    .payment-w-usp .icon-section .icon-box .icon span.svg-wrapper {
        width: 13px;
        height: 13px;
    }
  }
</style>


<!-- Section Scheme -->

{
  "type": "payment-w-usp",
  "name": "Payment with USP",
  "limit": 1,
  "settings": [
    {
      "type": "text",
      "id": "content",
      "label": "Content"
    },
    {
      "type": "header",
      "content": "USP One"
    },
    {
      "type": "text",
      "id": "usp_text_1",
      "label": "USP Text 1"
    },
    {
      "type": "select",
      "id": "usp_icon_1",
      "label": "USP Icon 1",
      "options": [
        {
          "value": "none",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__1.label"
        },
        {
          "value": "apple",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__2.label"
        },
        {
          "value": "banana",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__3.label"
        },
        {
          "value": "bottle",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__4.label"
        },
        {
          "value": "box",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__5.label"
        },
        {
          "value": "carrot",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__6.label"
        },
        {
          "value": "chat_bubble",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__7.label"
        },
        {
          "value": "check_mark",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__8.label"
        },
        {
          "value": "clipboard",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__9.label"
        },
        {
          "value": "dairy",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__10.label"
        },
        {
          "value": "dairy_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__11.label"
        },
        {
          "value": "dryer",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__12.label"
        },
        {
          "value": "eye",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__13.label"
        },
        {
          "value": "fire",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__14.label"
        },
        {
          "value": "gluten_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__15.label"
        },
        {
          "value": "heart",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__16.label"
        },
        {
          "value": "iron",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__17.label"
        },
        {
          "value": "leaf",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__18.label"
        },
        {
          "value": "leather",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__19.label"
        },
        {
          "value": "lightning_bolt",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__20.label"
        },
        {
          "value": "lipstick",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__21.label"
        },
        {
          "value": "lock",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__22.label"
        },
        {
          "value": "map_pin",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__23.label"
        },
        {
          "value": "nut_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__24.label"
        },
        {
          "value": "pants",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__25.label"
        },
        {
          "value": "paw_print",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__26.label"
        },
        {
          "value": "pepper",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__27.label"
        },
        {
          "value": "perfume",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__28.label"
        },
        {
          "value": "plane",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__29.label"
        },
        {
          "value": "plant",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__30.label"
        },
        {
          "value": "price_tag",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__31.label"
        },
        {
          "value": "question_mark",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__32.label"
        },
        {
          "value": "recycle",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__33.label"
        },
        {
          "value": "return",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__34.label"
        },
        {
          "value": "ruler",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__35.label"
        },
        {
          "value": "serving_dish",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__36.label"
        },
        {
          "value": "shirt",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__37.label"
        },
        {
          "value": "shoe",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__38.label"
        },
        {
          "value": "silhouette",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__39.label"
        },
        {
          "value": "snowflake",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__40.label"
        },
        {
          "value": "star",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__41.label"
        },
        {
          "value": "stopwatch",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__42.label"
        },
        {
          "value": "truck",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__43.label"
        },
        {
          "value": "washing",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__44.label"
        }
      ],
      "default": "check_mark"
    },
    {
      "type": "header",
      "content": "USP Two"
    },
    {
      "type": "text",
      "id": "usp_text_2",
      "label": "USP Text 2"
    },
    {
      "type": "select",
      "id": "usp_icon_2",
      "label": "USP Icon 2",
      "options": [
        {
          "value": "none",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__1.label"
        },
        {
          "value": "apple",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__2.label"
        },
        {
          "value": "banana",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__3.label"
        },
        {
          "value": "bottle",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__4.label"
        },
        {
          "value": "box",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__5.label"
        },
        {
          "value": "carrot",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__6.label"
        },
        {
          "value": "chat_bubble",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__7.label"
        },
        {
          "value": "check_mark",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__8.label"
        },
        {
          "value": "clipboard",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__9.label"
        },
        {
          "value": "dairy",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__10.label"
        },
        {
          "value": "dairy_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__11.label"
        },
        {
          "value": "dryer",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__12.label"
        },
        {
          "value": "eye",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__13.label"
        },
        {
          "value": "fire",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__14.label"
        },
        {
          "value": "gluten_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__15.label"
        },
        {
          "value": "heart",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__16.label"
        },
        {
          "value": "iron",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__17.label"
        },
        {
          "value": "leaf",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__18.label"
        },
        {
          "value": "leather",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__19.label"
        },
        {
          "value": "lightning_bolt",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__20.label"
        },
        {
          "value": "lipstick",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__21.label"
        },
        {
          "value": "lock",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__22.label"
        },
        {
          "value": "map_pin",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__23.label"
        },
        {
          "value": "nut_free",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__24.label"
        },
        {
          "value": "pants",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__25.label"
        },
        {
          "value": "paw_print",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__26.label"
        },
        {
          "value": "pepper",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__27.label"
        },
        {
          "value": "perfume",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__28.label"
        },
        {
          "value": "plane",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__29.label"
        },
        {
          "value": "plant",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__30.label"
        },
        {
          "value": "price_tag",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__31.label"
        },
        {
          "value": "question_mark",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__32.label"
        },
        {
          "value": "recycle",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__33.label"
        },
        {
          "value": "return",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__34.label"
        },
        {
          "value": "ruler",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__35.label"
        },
        {
          "value": "serving_dish",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__36.label"
        },
        {
          "value": "shirt",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__37.label"
        },
        {
          "value": "shoe",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__38.label"
        },
        {
          "value": "silhouette",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__39.label"
        },
        {
          "value": "snowflake",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__40.label"
        },
        {
          "value": "star",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__41.label"
        },
        {
          "value": "stopwatch",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__42.label"
        },
        {
          "value": "truck",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__43.label"
        },
        {
          "value": "washing",
          "label": "t:sections.main-product.blocks.collapsible_tab.settings.icon.options__44.label"
        }
      ],
      "default": "check_mark"
    }
  ]
},