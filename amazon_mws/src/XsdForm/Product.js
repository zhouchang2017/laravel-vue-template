const Product = {
  'SKU': {
    rules: {
      min: 1,
      max: 40
    },
    type: 'input'
  },
  'StandardProductID': {
    'Type': {
      rules: {
        in: ['ISBN', 'UPC', 'EAN', 'ASIN', 'GTIN', 'GCID', 'PZN']
      },
      type: 'select'
    },
    'Value': {
      rules: {
        min: 8,
        max: 16
      },
      type: 'input'
    }
  },
  'GtinExemptionReason': {
    rules: {
      in: ['bundle', 'part']
    },
    type: 'select'
  },
  'RelatedProductID': {
    'Type': {
      rules: {
        in: ['UPC', 'EAN', 'GTIN']
      },
      type: 'select'
    },
    'Value': {
      rules: {
        min: 8,
        max: 16
      },
      type: 'input'
    }
  },
  'ProductTaxCode': {
    rules: {
      min: 1,
      max: 50
    },
    type: 'input'
  },
  'LaunchDate': {
    type: 'input'
  },
  'DiscontinueDate': {
    type: 'input'
  },
  'ReleaseDate': {
    type: 'input'
  },
  'ExternalProductUrl': {
    rules: {
      url: true
    }
  },
  'ConditionInfo': {
    'ConditionType': {
      rules: {
        in: ['New', 'UsedLikeNew', 'UsedVeryGood', 'UsedGood', 'UsedAcceptable', 'CollectibleLikeNew', 'CollectibleVeryGood', 'CollectibleGood', 'CollectibleAcceptable', 'Refurbished', 'Club']
      },
      type: 'select'
    },
    'ConditionNote': {
      rules: {
        max: 2000
      },
      type: 'select'
    }
  },
  'Rebate': {
    // 最大出现次数2
    'RebateStartDate': {
      // dateTime
    },
    'RebateEndDate': {
      // dateTime
    },
    'RebateMessage': {
      rules: {
        min: 1,
        max: 250
      }
    },
    'RebateName': {
      rules: {
        min: 1,
        max: 40
      }
    },
    'ItemPackageQuantity': {
      rules: {
        numeric: true
      },
      tips: `Use this field to indicate the number of units included
            in the item you are offering for sale, such that each unit is packaged
            for individual sale.`
    },
    'NumberOfItems': {
      rules: {
        numeric: true
      },
      tips: `Use this field to indicate the number of discrete items
            included in the item you are offering for sale, such that each item is
            not packaged for individual sale. For example, if you are selling a case
            of 10 packages of socks, and each package contains 3 pairs of socks, the
            case would have ItemPackageQuantity = 10 and NumberOfItems = 30.`
    },
    'LiquidVolume': {}
  }
}
// 产品上传对象
let obj = {
  'Product': {
    'xmlns:xsi': 'http://www.w3.org/2001/XMLSchema-instance',
    'xsi:noNamespaceSchemaLocation': 'file:/Users/z/Documents/code/laravel-vue-template/amazon_mws/src/Xsd/Product.xsd',
    'SKU': 'SKU0',
    // 产品的标准唯一标识符，由一个类型（ISBN，UPC或EAN）和一个符合指定类型的适当格式的值组成。如果在基本XSD中为StandardProductID提供了Type，则这是必填字段。
    'StandardProductID': {'Type': 'ISBN', 'Value': 'Value111'},
    'GtinExemptionReason': 'bundle',
    'RelatedProductID': {'Type': 'UPC', 'Value': 'Value333'},
    // 亚马逊的标准代码来识别产品的税收属性。税码是第一位的
    // 在产品订阅中标识并在订购产品后传递给订单报告。不在加拿大，欧洲或日本使用。
    'ProductTaxCode': 'ProductTaxCode0',
    // 控制产品何时出现在搜索和浏览亚马逊网站上
    'LaunchDate': '2006-05-04T18:13:51.0',
    'DiscontinueDate': '2006-05-04T18:13:51.0',
    // 产品发售日期
    'ReleaseDate': '2006-05-04T18:13:51.0',
    // 外部产品地址
    'ExternalProductUrl': 'http://www.oxygenxml.com/',
    'Condition': {'ConditionType': 'New', 'ConditionNote': 'ConditionNote0'},
    // Not used in Europe or Japan.
    'Rebate': [{
      'RebateStartDate': '2006-05-04T18:13:51.0',
      'RebateEndDate': '2006-05-04T18:13:51.0',
      'RebateMessage': 'RebateMessage0',
      'RebateName': 'RebateName0'
    }, {
      'RebateStartDate': '2006-05-04T18:13:51.0',
      'RebateEndDate': '2006-05-04T18:13:51.0',
      'RebateMessage': 'RebateMessage1',
      'RebateName': 'RebateName1'
    }],
    'ItemPackageQuantity': 50,
    'NumberOfItems': 50,
    'LiquidVolume': {'unitOfMeasure': 'cubic-cm', 'content': 0},
    // 产品描述
    'DescriptionData': {
      'Title': 'Title0',
      'Brand': 'Brand0',
      'Designer': 'Designer0',
      'Description': 'Description0',
      // 产品功能的简要说明
      'BulletPoint': ['BulletPoint0', 'BulletPoint1'],
      // 产品的计算尺寸
      'ItemDimensions': {
        'Length': {'unitOfMeasure': 'MM', 'content': 0},
        'Width': {'unitOfMeasure': 'MM', 'content': 0},
        'Height': {'unitOfMeasure': 'MM', 'content': 0},
        'Weight': {'unitOfMeasure': 'GR', 'content': 0}
      },
      // 包装的计算尺寸
      'PackageDimensions': {
        'Length': {'unitOfMeasure': 'MM', 'content': 0},
        'Width': {'unitOfMeasure': 'MM', 'content': 0},
        'Height': {'unitOfMeasure': 'MM', 'content': 0},
        'Weight': {'unitOfMeasure': 'GR', 'content': 0}
      },
      // 包装的重量
      'PackageWeight': {'unitOfMeasure': 'GR', 'content': 50},
      // 产品包装运输时的重量
      'ShippingWeight': {'unitOfMeasure': 'GR', 'content': 50},
      // 卖家的产品目录号，如果与SKU不同
      'MerchantCatalogNumber': 'MerchantCatalogNumber0',
      // 制造商建议的产品零售价格
      'MSRP': {'currency': 'USD', 'content': 0},
      'MSRPWithTax': {'currency': 'USD', 'content': 0},
      //  客户可以订购的产品的最大数量
      'MaxOrderQuantity': 50,
      // 表示产品是否必须具有序列号
      'SerialNumberRequired': false,
      // 如果产品在加利福尼亚州遵守Prop65的规定，则使用该产品。不在加拿大，欧洲或日本使用
      'Prop65': false,
      // 产品所需的任何法律声明
      'CPSIAWarning': ['choking_hazard_balloon', 'choking_hazard_balloon'],
      'CPSIAWarningDescription': 'CPSIAWarningDescription0',
      'LegalDisclaimer': 'LegalDisclaimer0',
      'Manufacturer': 'Manufacturer0',
      //  由原始制造商提供的部件号
      'MfrPartNumber': 'MfrPartNumber0',
      // 当客户使用条款进行搜索时，提交的产品搜索结果条款
      'SearchTerms': ['SearchTerms0', 'SearchTerms1'],
      //  用于将产品映射到自定义浏览结构中的节点的值
      'PlatinumKeywords': ['PlatinumKeywords0', 'PlatinumKeywords1'],
      'Memorabilia': false,
      'Autographed': false,
      // What the product is used for (affects the product's placement in the Amazon
      // browse structure).   Not used in Canada, Europe, or Japan.
      'UsedFor': ['UsedFor0', 'UsedFor1'],
      // 预定义的值，用于指定产品在亚马逊浏览结构中的显示位置
      'ItemType': 'ItemType0',
      // 用于在Amazon浏览结构中进一步对产品进行分类
      'OtherItemAttributes': ['OtherItemAttributes0', 'OtherItemAttributes1'],
      // 用于在亚马逊浏览结构内进一步对产品进行分类。
      'TargetAudience': ['TargetAudience0', 'TargetAudience1'],
      // 用于将产品与商品销售的特定想法或概念联系起来
      'SubjectContent': ['SubjectContent0', 'SubjectContent1'],
      // 指示礼品包装是否可用于产品I
      'IsGiftWrapAvailable': false,
      // 指示礼品消息是否可用于产品
      'IsGiftMessageAvailable': false,
      'PromotionKeywords': ['PromotionKeywords0', 'PromotionKeywords1'],
      // 表示制造商已停止制作该项目
      'IsDiscontinuedByManufacturer': false,
      'DeliveryScheduleGroupID': 'DeliveryScheduleGroupID0',
      'DeliveryChannel': ['in_store', 'in_store'],
      'ExternalProductInformation': 'ExternalProductInformation0',
      // 可以在同一包装中发货的最大数量
      'MaxAggregateShipQuantity': 50,
      // 用于对项目进行分类的值（例如，Shoes> Men's
      // 鞋>足球鞋）。加拿大，欧洲和日本必须提供;不在美国使用。有关亚马逊浏览树指南（BTG）文档的更多信息，请参阅卖家中心帮助页面。
      'RecommendedBrowseNode': [50, 50],

      'MerchantShippingGroupName': 'MerchantShippingGroupName0',
      'FEDAS_ID': 'FEDAS_',
      // 产品使用年限警告（欧盟玩具安全指令2009/48 / EC）
      'TSDAgeWarning': 'not_suitable_under_36_months',
      // 产品警告代码（欧盟玩具安全指令2009/48 / EC）
      'TSDWarning': ['only_domestic_use', 'only_domestic_use'],
      // 产品警告语言
      'TSDLanguage': ['English', 'English'],
      'OptionalPaymentTypeExclusion': 'cash_on_delivery',
      'DistributionDesignation': 'jp_parallel_import',
      'ExternalTestingCertification': ['ExternalTestingCertification0', 'ExternalTestingCertification1'],
      'Battery': {
        'AreBatteriesIncluded': false,
        'AreBatteriesRequired': false,
        'BatterySubgroup': [{
          'BatteryType': 'battery_type_2/3A',
          'NumberOfBatteries': 50
        }, {'BatteryType': 'battery_type_2/3A', 'NumberOfBatteries': 50}]
      },
      'BatteryCellType': 'NiCAD',
      'BatteryWeight': {'unitOfMeasure': 'GR', 'content': 0},
      'NumberOfLithiumMetalCells': 50,
      'NumberOfLithiumIonCells': 50,
      'LithiumBatteryPackaging': 'batteries_contained_in_equipment',
      'LithiumBatteryEnergyContent': {'unitOfMeasure': 'kilowatt_hours', 'content': 0},
      'LithiumBatteryWeight': {'unitOfMeasure': 'GR', 'content': 0},
      'ItemWeight': {'unitOfMeasure': 'GR', 'content': 0},
      'ItemVolume': {'unitOfMeasure': 'cubic-cm', 'content': 0},
      'FlashPoint': 'FlashPoint0',
      'GHSClassificationClass': ['explosive', 'explosive'],
      'SupplierDeclaredDGHZRegulation': ['ghs', 'ghs'],
      'HazmatUnitedNationsRegulatoryID': 'HazmatUnitedNationsRegulatoryID0',
      'SafetyDataSheetURL': 'http://www.oxygenxml.com/'
    },
    'DiscoveryData': {'Priority': 6, 'BrowseExclusion': false, 'RecommendationExclusion': false},
    'ProductData': {
      'SportsMemorabilia': {
        'ProductType': 'SportsMemorabilia',
        'AuthenticatedBy': 'AuthenticatedBy0',
        'AuthenticityCertificateNumber': 'AuthenticityCertificateNumber0',
        'Autographed': false,
        'ConditionProvidedBy': 'ConditionProvidedBy0',
        'ConditionRating': 'ConditionRating0',
        'EventName': 'EventName1',
        'GameUsed': 'GameUsed0',
        'IsVeryHighValue': false,
        'ItemThickness': {'unitOfMeasure': 'MM', 'content': 0},
        'JerseyType': 'JerseyType1',
        'LeagueName': 'LeagueName1',
        'LotType': 'LotType0',
        'Material': 'Material3',
        'NumberOfPages': 50,
        'NumberOfPieces': 50,
        'Packaging': 'Packaging1',
        'PlayerName': 'PlayerName1',
        'Season': 'Season2',
        'SignedBy': 'SignedBy0',
        'Sport': 'Sport1',
        'TeamName': 'TeamName1',
        'UniformNumber': 50,
        'WhatsInTheBox': 'WhatsInTheBox1',
        'Year': 50,
        'MakeAnOfferMinimumPercentage': 0,
        'UnitCount': 0,
        'UnitCountType': 'UnitCountType0',
        'CardNumber': 'CardNumber0',
        'ParallelType': 'ParallelType0',
        'InsertType': 'InsertType0'
      }
    },
    'ShippedByFreight': false,
    // 增强的图片网址
    'EnhancedImageURL': 'http://www.oxygenxml.com/',
    'Amazon-Vendor-Only': {'Cost': {'currency': 'USD', 'content': 0}},
    'Amazon-Only': {
      'Tier': 50,
      'PurchasingCategory': 'PurchasingCategory0',
      'PurchasingSubCategory': 'PurchasingSubCategory0',
      'PackagingType': 'PackagingType0',
      'UnderlyingAvailability': 'backordered',
      'ReplenishmentCategory': 'basic-replenishment',
      'DropShipStatus': 'drop-ship-disabled',
      'OutOfStockWebsiteMessage': 'email-me-when-available'
    },
    'RegisteredParameter': 'PrivateLabel',
    'NationalStockNumber': 'NationalStockNumber0',
    'UnspscCode': 'UnspscCode0'
  }
}

