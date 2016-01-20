<?php

/* modules/contrib/views_slideshow/templates/views-slideshow-pager-field-field.html.twig */
class __TwigTemplate_57002115dd7561919f37736e5dcfa4a76dac75d137c6dacb145f1b0b13fcdbc9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 2);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "<div class=\"views-field-";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["css_identifier"]) ? $context["css_identifier"] : null), "html", null, true));
        echo "\">
  ";
        // line 2
        if ((isset($context["label"]) ? $context["label"] : null)) {
            // line 3
            echo "    <label class=\"view-label-";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["css_identifier"]) ? $context["css_identifier"] : null), "html", null, true));
            echo "\"> 
      ";
            // line 4
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["label"]) ? $context["label"] : null), "html", null, true));
            echo ":
    </label>
   ";
        }
        // line 7
        echo "   <div class=\"views-content-";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["css_identifier"]) ? $context["css_identifier"] : null), "html", null, true));
        echo "\"> 
    ";
        // line 8
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["output"]) ? $context["output"] : null), "html", null, true));
        echo "
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/contrib/views_slideshow/templates/views-slideshow-pager-field-field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 8,  61 => 7,  55 => 4,  50 => 3,  48 => 2,  43 => 1,);
    }
}
/* <div class="views-field-{{ css_identifier }}">*/
/*   {% if label %}*/
/*     <label class="view-label-{{ css_identifier }}"> */
/*       {{ label }}:*/
/*     </label>*/
/*    {% endif %}*/
/*    <div class="views-content-{{ css_identifier }}"> */
/*     {{ output }}*/
/*   </div>*/
/* </div>*/
