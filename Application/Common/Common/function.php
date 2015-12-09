<?php
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array ();
    if (is_array ( $list )) {
        // 创建基于主键的数组引用
        $refer = array ();
        foreach ( $list as $key => $data ) {
                $refer [$data [$pk]] = & $list [$key];
        }
        foreach ( $list as $key => $data ) {
            // 判断是否存在parent
            $parentId = $data [$pid];
            if ($root == $parentId) {
                $tree [] = & $list [$key];
            } else {
                if (isset ( $refer [$parentId] )) {
                    $parent = & $refer [$parentId];
                    $parent [$child] [] = & $list [$key];
                }
            }
        }
    }
    return $tree;
}

/*
 * 微信不接收\u***格式的json内容需要对json字符串处理
 * 仅支持发送text消息，其他类型消息自己添加代码
 * @param string msgtype
 * @param array
 * @return string
 */
function my_json_encode($type, $p)
{
    if (PHP_VERSION >= '5.4')
    {
        $str = json_encode($p, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    else
    {
        switch ($type)
        {
            case 'text':
                isset($p['text']['content']) && ($p['text']['content'] = urlencode($p['text']['content']));
                break;
        }
        $str = urldecode(json_encode($p));
    }
    return $str;
}
