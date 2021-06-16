<?php

use MailPoetVendor\Twig\Environment;
use MailPoetVendor\Twig\Error\LoaderError;
use MailPoetVendor\Twig\Error\RuntimeError;
use MailPoetVendor\Twig\Markup;
use MailPoetVendor\Twig\Sandbox\SecurityError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedTagError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFilterError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFunctionError;
use MailPoetVendor\Twig\Source;
use MailPoetVendor\Twig\Template;

/* form/templatesLegacy/settings/label_within.hbs */
class __TwigTemplate_d96fe7653bcb2e1d7fe5d98be5004da70129ab9ef74cff92fdc2e6b041dfbd32 extends \MailPoetVendor\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<p class=\"clearfix\">
  <label>";
        // line 2
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Display label within input:");
        echo "</label>
  <span class=\"group\">
    <label>
      <input class=\"mailpoet_radio\" type=\"radio\" name=\"params[label_within]\" value=\"1\" {{#if params.label_within}}checked=\"checked\"{{/if}} />";
        // line 5
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes");
        echo "
    </label>
    <label>
      <input class=\"mailpoet_radio\" type=\"radio\" name=\"params[label_within]\" value=\"\" {{#unless params.label_within}}checked=\"checked\"{{/unless}} />";
        // line 8
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "
    </label>
  </span>
</p>";
    }

    public function getTemplateName()
    {
        return "form/templatesLegacy/settings/label_within.hbs";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 8,  39 => 5,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "form/templatesLegacy/settings/label_within.hbs", "/home/kusanagi/stg/DocumentRoot/wp-content/plugins/mailpoet/views/form/templatesLegacy/settings/label_within.hbs");
    }
}
