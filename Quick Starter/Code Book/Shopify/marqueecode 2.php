{% style %}
  /* Variables */
  .ed_marquee#ed_section-{{ section.id }} {
    --background-color: {{ section.settings.background_color }};
    --border-color: {{ section.settings.border_color }};
    --border-thickness: {{ section.settings.border_thickness }}px;
    --text-color: {{ section.settings.text_color }} !important;
    --section-padding-top: {{ section.settings.section_padding_top }}px;
    --section-padding-bottom: {{ section.settings.section_padding_bottom }}px;
    --marquee-padding-top: {{ section.settings.padding_top }}px;
    --marquee-padding-bottom: {{ section.settings.padding_bottom }}px;
    --scroll-speed: {{ section.settings.speed }}s;
    --gap: {{ section.settings.gap | divided_by: 2 }}px;
    --mobile-gap: {{ section.settings.mobile_gap | divided_by: 2 }}px;
    --font-size: {{ section.settings.font_size }}px;
    --line-height: {{ section.settings.line_height }}%;
    --letter-spacing: {{ section.settings.letter_spacing }}px;
    --font-size-mobile: {{ section.settings.font_size_mobile }}px;
    --line-height-mobile: {{ section.settings.line_height_mobile }}%;
    --letter-spacing-mobile: {{ section.settings.letter_spacing_mobile }}px;
  }
  /* Animation settings */
  {% if section.settings.direction == 'right' %} #ed_section-{{ section.id }} .marquee-group { animation-direction: reverse; } {% endif %}
  {% if section.settings.pause_on_hover %} #ed_section-{{ section.id }} .marquee-inner:hover .marquee-group { animation-play-state: paused; } {% endif %}
  /* Font settings */
  {% if section.settings.override_font %}
    {{ section.settings.font | font_face }} /* @font-face */
    #ed_section-{{ section.id }} .marquee-group {
      font-family: {{ section.settings.font.family }};
      font-style: {{ section.settings.font.style }};
      font-weight: {{ section.settings.font.weight }};  
    }
  {% endif %}
  /* Border settings */
  {% if section.settings.enable_border %}
    .ed_marquee#ed_section-{{ section.id }} .marquee-inner {
      border-top: {{ section.settings.border_top_thickness }}px solid  var(--border-color);
      border-bottom: {{ section.settings.border_bottom_thickness }}px solid var(--border-color);
    }
  {% endif %}
  /* Reset any weird theme spacings */
  .ed_marquee .marquee-group * {
    margin: 0;
    padding: 0;
  }
  /* Styles */
  .ed_marquee {
		width: 100%;
		max-width: 100vw;
    /* padding-top: var(--section-padding-top);
    padding-bottom: var(--section-padding-bottom); */
  }
  @media screen and (max-width: 600px) {
    .ed_marquee {
      padding-top: calc(var(--section-padding-top) * 0.75);
      padding-bottom: calc(var(--section-padding-bottom) * 0.75);
    }
  }
  .ed_marquee .marquee-inner {
    display: flex;
    overflow: hidden;
    align-items: center;
    white-space: nowrap;
    background-color: var(--background-color);
    color: var(--text-color) !important;;
    padding-top: var(--marquee-padding-top);
    padding-bottom: var(--marquee-padding-bottom);
    border-left: 0;
    border-right: 0;
  }
  .ed_marquee a.marquee-inner {
    text-decoration: none;
    color: var(--text-color) !important;;
  }
  @keyframes scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-100%); }
  }
  /* Each marquee-group must be the same width for the scroll effect to work.
  To make it look like each block is separate, we need an equal gap between marquee groups and between items inside them  */
  .ed_marquee .marquee-group {
    padding: 0 var(--gap);
    gap: calc(var(--gap) * 2);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex: 1 0 auto;
    animation: scroll var(--scroll-speed) linear infinite;
    will-change: transform;
  }
  @media screen and (max-width: 600px) {
    .ed_marquee .marquee-group {
      padding: 0 var(--mobile-gap);
      gap: calc(var(--mobile-gap) * 2);
    }
  }
  .ed_marquee .marquee-group * {
    font-size: var(--font-size);
    line-height: var(--line-height);
    letter-spacing: var(--letter-spacing);
  }
  @media screen and (max-width: 600px) {
    .ed_marquee .marquee-group * {
      font-size: var(--font-size-mobile);
      line-height: var(--line-height-mobile);
      letter-spacing: var(--letter-spacing-mobile);
    }
  }
  .ed_marquee .marquee-group img {
    height: calc(var(--font-size) * 1.5);
    width: auto;
  }
  @media screen and (max-width: 600px) {
    .ed_marquee .marquee-group img {
      height: calc(var(--font-size-mobile) * 1.5);
    }
  }
.marquee-group h2 {
    color: #fff;
}
{% endstyle %}

{% capture marquee_inner %}
  {% if section.settings.link %}
    {% if section.settings.newtab %}
      <a href="{{ section.settings.link }}" target="_blank" class="marquee-inner"> 
    {% else %}
      <a href="{{ section.settings.link }}" class="marquee-inner"> 
    {% endif %}
  {% else %} 
    <div class="marquee-inner"> 
  {% endif %}
{% endcapture %}

<div class="ed_marquee {{ section.settings.custom_class }} {% if section.settings.borderbottom == true %}section-border-bottom{% endif %}" id="ed_section-{{ section.id }}">
  {{ marquee_inner }}
    {%- assign duplicates = section.settings.duplicates -%}
    {%- for i in (1..duplicates) -%}
    <div class="marquee-group" {% if forloop.index > 1 %} aria-hidden="true" {% endif %} >
        {%- for block in section.blocks -%}
          {%- case block.type -%}
            {%- when 'image' -%}
              {%- if block.settings.marquee_image -%}
                {{ block.settings.marquee_image | image_url: width: 200 | image_tag }}
              {%- endif -%}
            {%- when 'text' -%}
              {{ block.settings.content }}
            {%- when 'liquid' -%}
              {{ block.settings.liquid }}
          {%- endcase -%}
        {%- endfor -%}
      </div>
    {%- endfor -%}
  {% if section.settings.link %} </a> {% else %} </div> {% endif %}
</div>

{% schema %}
{
  "name": "⚡️ Marquee",
  "settings": [
    {
      "type": "checkbox",
      "id": "borderbottom",
      "label": "Border Bottom",
      "default": false,
      "info": "Enable it to show thik border at bottom"
    },
    {
      "type": "header",
      "content": "⚡️ Marquee by ed.codes",
      "info": "Purchased from https://edcodes.gumroad.com/l/marquee. For support or feedback, please contact hi@ed.codes."
    },
    {
      "type": "header",
      "content": "Link"
    },
    {
      "type": "url",
      "id": "link",
      "label": "Link",
      "info": "If you don't want to link anywhere, leave this blank."
    },
    {
      "type": "checkbox",
      "id": "newtab",
      "label": "Open link in a new tab",
      "default": false
    },
    {
      "type": "header",
      "content": "Animation"
    },
    {
      "type": "range",
      "id": "speed",
      "label": "Speed",
      "info": "Note: Content length also affects speed. Longer text goes faster to cross the screen in the same time.",
      "min": 1,
      "max": 100,
      "default": 10,
      "unit": "sec"
    },
    {
      "type": "checkbox",
      "id": "pause_on_hover",
      "label": "Pause on hover",
      "default": false
    },
    {
      "type": "select",
      "id": "direction",
      "label": "Direction",
      "default": "left",
      "options": [
        {
          "value": "left",
          "label": "Left"
        },
        {
          "value": "right",
          "label": "Right"
        }
      ]
    },
    {
      "type": "range",
      "id": "duplicates",
      "label": "Number of duplicates",
      "min": 6,
      "max": 30,
      "step": 2,
      "default": 12,
      "info": "Number of times to duplicate the content. This is to make sure you can't see the end of the marquee on larger screens. 8 to 12 duplicates is usually enough, but increase it if your content is short."
    },
    {
      "type": "header",
      "content": "Colors"
    },
    {
      "type": "color",
      "id": "background_color",
      "label": "Background Color",
      "default": "#f5f5f5"
    },
    {
      "type": "color",
      "id": "text_color",
      "label": "Text Color",
      "default": "#000"
    },
    {
      "type": "header",
      "content": "Border"
    },
    {
      "type": "checkbox",
      "id": "enable_border",
      "label": "Enable Borders",
      "default": true
    },
    {
      "type": "color",
      "id": "border_color",
      "label": "Border Color",
      "default": "#000"
    },
    {
      "type": "range",
      "id": "border_top_thickness",
      "label": "Border top thickness",
      "min": 0,
      "max": 10,
      "step": 1,
      "unit": "px",
      "default": 1
    },
    {
      "type": "range",
      "id": "border_bottom_thickness",
      "label": "Border bottom thickness",
      "min": 0,
      "max": 10,
      "step": 1,
      "unit": "px",
      "default": 1
    },
    {
      "type": "header",
      "content": "Typography"
    },
    {
      "type": "range",
      "id": "font_size",
      "label": "Font size", 
      "min": 4,
      "max": 120,
      "step": 2,
      "unit": "px",
      "default": 16
    },
    {
      "type": "range",
      "id": "font_size_mobile",
      "label": "Font size (mobile)", 
      "min": 4,
      "max": 120,
      "step": 2,
      "unit": "px",
      "default": 16
    },
    {
      "type": "range",
      "id": "line_height",
      "label": "Line height",
      "min": 100,
      "max": 200,
      "step": 10,
      "unit": "%",
      "default": 130
    },
    {
      "type": "range",
      "id": "line_height_mobile",
      "label": "Line height (mobile)",
      "min": 100,
      "max": 200,
      "step": 10,
      "unit": "%",
      "default": 130
    },
    {
      "type": "range",
      "id": "letter_spacing",
      "label": "Letter spacing",
      "min": -10,
      "max": 10,
      "step": 0.5,
      "unit": "px",
      "default": 0
    },
    {
      "type": "range",
      "id": "letter_spacing_mobile",
      "label": "Letter spacing (mobile)",
      "min": -10,
      "max": 10,
      "step": 0.5,
      "unit": "px",
      "default": 0
    },
    {
      "type": "checkbox",
      "id": "override_font",
      "label": "Override theme font",
      "info": "If you want to use a different font than the one set in your theme typography settings, enable this and select a font below.",
      "default": false
    },
    {
      "type": "font_picker",
      "id": "font",
      "label": "Font",
      "default": "sans-serif"
    },
    {
      "type": "header",
      "content": "Spacing"
    },
    {
      "type": "range",
      "id": "gap",
      "label": "Gap",
      "info": "Space between items",
      "min": 0,
      "max": 200,
      "step": 2,
      "unit": "px",
      "default": 20
    },
    {
      "type": "range",
      "id": "mobile_gap",
      "label": "Mobile Gap",
      "info": "Space between items",
      "min": 0,
      "max": 200,
      "step": 2,
      "unit": "px",
      "default": 20
    },
    {
      "type": "header",
      "content": "Marquee padding",
      "info": "Padding inside the marquee (area inside borders if you applied them)"
    },
    {
      "type": "range",
      "id": "padding_top",
      "min": 0,
      "max": 50,
      "step": 2,
      "unit": "px",
      "label": "Top padding",
      "default": 6
    },
    {
      "type": "range",
      "id": "padding_bottom",
      "min": 0,
      "max": 50,
      "step": 2,
      "unit": "px",
      "label": "Bottom padding",
      "default": 6
    },
    {
      "type": "header",
      "content": "Section padding",
      "info": "Padding outside the marquee (i.e. space between this and other sections)"
    },
    {
      "type": "range",
      "id": "section_padding_top",
      "min": 0,
      "max": 100,
      "step": 4,
      "unit": "px",
      "label": "Top padding",
      "default": 40
    },
    {
      "type": "range",
      "id": "section_padding_bottom",
      "min": 0,
      "max": 100,
      "step": 4,
      "unit": "px",
      "label": "Bottom padding",
      "default": 52
    },
    {
      "type": "header",
      "content": "Misc"
    },
    {
      "type": "text",
      "id": "custom_class",
      "label": "Custom class",
      "info": "Add a class to the section if you want to target it with CSS from elsewhere in your theme."
    }
  ],
  "blocks": [
    {
      "type": "text",
      "name": "Text",
      "settings": [
        {
          "type": "richtext",
          "id": "content",
          "label": "Content"
        }
      ]
    },
    {
      "type": "image",
      "name": "Image",
      "settings": [
        {
          "type": "image_picker",
          "id": "marquee_image",
          "label": "Image"
        }
      ]
    },
    {
      "type": "liquid",
      "name": "Liquid",
      "settings": [
        {
          "type": "liquid",
          "id": "liquid",
          "label": "Liquid"
        }
      ]
    }
  ],
  "presets": [
    {
      "name": "⚡️ Marquee",
      "category": "Image",
      "blocks": [
        {
          "type": "text",
          "settings": {
            "content": "<p>Free shipping</p>"
          }
        }
      ]
    }
  ]
}
{% endschema %}