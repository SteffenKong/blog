//wang编辑器配置
var E = window.wangEditor;
var editor = new E('#editor');

// 下面两个配置，使用其中一个即可显示“上传图片”的tab。但是两者不要同时使用！！！
editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片
// editor.customConfig.uploadImgServer = '/upload'  // 上传图片到服务器

editor.create()
