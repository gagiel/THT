<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 带复选框的树
 */
if (!function_exists('tree_check')) {
    function tree_check($arr)
    {
        $html = '';
        foreach ($arr as $t) {
            $self = $t['self'];
            if (!empty($t['child'])) {
                $html .='<li>' .
                		'<input type="checkbox" class="check_tree" name="tree[]" value="' . $self->id . '" />' .
                		$self->name . 
                		tree_check($t['child']) .
                		'</li>';
            } else {
                $html .='<li>' .
                		'<input type="checkbox" class="check_tree" name="tree[]" value="' . $self->id . '" onClick="treeClick(this,\'' . $self->detail . '\')" />' .
                		$self->name . 
						'</li>';
            }
        }
        return $html ? '<ul>' . $html . '</ul>' : $html;
    }
}

/**
 * 新闻类型树
 */
if (!function_exists('tree_ntype')) {
    function tree_ntype($arr,$open = array())
    {
        $html = '';
        foreach ($arr as $t) {
            $self = $t['self'];
            if (isset($t['child']) && count($t['child'])>0 && !empty($t['child'])) {
                $html .='<li class="' . ( in_array($self->id,$open) ? 'Opened' : 'Closed' ) .'" id="id_' . $self->id . '"> ' .
                		'<img class="s" alt="展开/折叠" id="' . $self->id . '" onclick="treeClick(this);" src="/images/s.gif"/> ';
            } else {
                $html .='<li class="Child" id="id_' . $self->id . '"> ' .
                		'<img class="s" alt="展开/折叠" src="/images/s.gif"/> ';
            }
            $html .='<a id="name_' . $self->id . '" class="tree_name_a"><span class="tree_name_span">' . $self->name . '</span></a> ' .
            		'<input name="" type="hidden" value="'.$self->parent.'" id="parent_' . $self->id . '" />' .
            		((strpos ($self->detail , '.')>0)?'':'<a onClick="addInfo(' . $self->id . ')"><input name="" type="button" value="新增" class="s_bnt01" /></a> ') .//双层限制
            		'<a onClick="editInfo(' . $self->id . ')"><input name="" type="button" value="修改" class="s_bnt01 green" /></a> ' .
            		'<a onClick="delInfo(' . $self->id . ')"><input name="" type="button" value="删除" class="s_bnt01 red" /></a> ' .
            		'<a onClick="markUp(' . $self->id . ')"><input name="" type="button" value="上移" class="s_bnt04_u"></a> ' .
            		'<a onClick="markDown(' . $self->id . ')"><input name="" type="button" value="下移" class="s_bnt04_d"></a> ';
            if (!empty($t['child'])) {
            	$html .=tree_ntype($t['child'],$open);
            }
            $html .='</li>';
        }
        return $html ? '<ul>' . $html . '</ul>' : $html;
    }
}

if (!function_exists('tree_ncheck')) {
    function tree_ncheck($arr,$open = array())
    {
        $html = '';
        foreach ($arr as $t) {
            $self = $t['self'];
            if (isset($t['child']) && count($t['child'])>0 && !empty($t['child'])) {
                $html .='<li class="Opened"> ';
            } else {
                $html .='<li class="Child"> ';
            }
            $html .='<img class="s" alt="展开/折叠" src="/images/s.gif"/> ' .
					'<a id="name_' . $self->id . '" class="tree_name_a"><span class="tree_name_span">' . $self->name . '</span></a> ' .
            		'<a class="check_a"><input  type="checkbox" class="check_tree" name="tree[]" value="' . $self->id . '" '.(in_array($self->id,$open)?' checked':'').' onclick="checkone(this);" /></a> ' .
            		'<a onClick="markUp(this)"><input name="" type="button" value="上移" class="s_bnt04_u"></a> ' .
            		'<a onClick="markDown(this)"><input name="" type="button" value="下移" class="s_bnt04_d"></a> ';
            if (!empty($t['child'])) {
            	$html .=tree_ncheck($t['child'],$open);
            }
            $html .='</li>';
        }
        return $html ? '<ul class="tree_ul">' . $html . '</ul>' : $html;
    }
}

/**
 * 企业类型树
 */
if (!function_exists('type_check')) {
    function type_check($arr)
    {
        $html = '';
        foreach ($arr as $t) {
            $self = $t['self'];
            if (!empty($t['child'])) {
                $html .='<li class="Closed" id="id_' . $self['id'] . '" >' .
                		'<img class="s" alt="展开/折叠" onclick="ExCls(this,\'Opened\',\'Closed\',1);" src="/images/s.gif"/>';
            } else {
                $html .='<li class="Child" id="id_' . $self['id'] . '" >' .
                		'<img class="s" alt="展开/折叠" src="/images/s.gif"/>';
            }
            $html .='<a class="tree_name_a"><span class="tree_name_span">' . $self['name'] . '</span></a>' .
            		'<a onClick="addInfo(' . $self['id'] . ')"><input name="" type="button" value="新增" class="s_bnt01" /></a>' .
            		'<a onClick="delInfo(' . $self['id'] . ')"><input name="" type="button" value="删除" class="s_bnt01 red" /></a>' .
            		'<a onClick="editInfo(' . $self['id'] . ')"><input name="" type="button" value="修改" class="s_bnt01 green"/></a>' .
            		'<a><input name="" type="hidden" value="' . $self['parentname'] . '"/></a>' .
            		'<input name="" type="button" value="向上" class="s_bnt04_u" onClick="markupInfo(' . $self['id'] . ')"/>' .
            		'<input name="" type="button" value="向下" class="s_bnt04_d" onClick="markdownInfo(' . $self['id'] . ')"/>';
            if (!empty($t['child'])) {
            	$html .=type_check($t['child']);
            }
            $html .='</li>';
        }
        return $html ? '<ul>' . $html . '</ul>' : $html;
    }
}