<?php
class ContentLayout {
    function doContentLayout() {
        global $OUT;
        $CI =& get_instance();

        // 출력된 뷰단
        $output = $CI->output->get_output();
        // 레이아웃 사용여부 (false시 뷰를 그대로 출력)
        // controller 에서 $this->isUseLayout = false; 시 미사용처리
        $CI->isUseLayout = isset($CI->isUseLayout) ? $CI->isUseLayout : TRUE;

        if ($CI->isUseLayout === TRUE) {
            // 레이아웃 불러오기
            // 다른 레이아웃 선택시 $this->layout = 파일명; views/layouts/파일명 호출
            $CI->layout = isset($CI->layout) ? $CI->layout : 'default';
            if (!preg_match('/(.+).php$/', $CI->layout)) {
                $CI->layout .= '.php';
            }
            $requested = APPPATH . 'views/layouts/' . $CI->layout;
            $layout = $CI->load->file($requested, TRUE);

            // 레이아웃 가공
            $headTag = $this->inner_content($output, '{head}', '{/head}', FALSE);
            $bodyTag = $this->inner_content($output, '{body}', '{/body}', TRUE);
            $layout = $this->str_replace_once('{%HEAD_CONTENT%}', $headTag, $layout);
            $layout = $this->str_replace_once('{%BODY_CONTENT%}', $bodyTag, $layout);
        } else {
            $layout = $output;
        }

        // 레이아웃 출력
        $OUT->_display($layout);
    }

    // str_replace 를 1회만 적용
    private function str_replace_once($search, $replace, $subject) {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

    // startTag ~ endTag 사이의 컨텐츠를 리턴
    private function inner_content($subject, $startTag, $endTag, $returnValue = FALSE) {
        $value = $returnValue ? $subject : '';
        $startPos = strpos($subject, $startTag);
        if ($startPos !== false) {
            $startPos += strlen($startTag)+1;
            $endPos = strpos($subject, $endTag);
            if ($endPos === false) {
                $endPos = strlen($subject)-1;
            }
            $value = substr($subject, $startPos, $endPos-$startPos-1);
        }
        return $value;
    }
}
?>
