package main

import (
	"fmt"
	"math/rand"
	"time"
)

const MAX_LEVEL = 32

type SkipNode struct {
	key     int
	value   string
	forward []*SkipNode
}

type SkipList struct {
	length int
	header *SkipNode
	tail   *SkipNode
	level  int
}

func NewSkipNode() *SkipNode {
	return &SkipNode{forward: make([]*SkipNode, MAX_LEVEL)}
}

func (skiplist *SkipList) MakeSkipNode(key int, value string) *SkipNode {
	newNode := NewSkipNode()
	newNode.key = key
	newNode.value = value

	return newNode
}

func NewSkipList() *SkipList {
	newskl := &SkipList{}

	newskl.length = 0
	newskl.header = NewSkipNode()
	newskl.tail = nil
	newskl.level = 1
	i := 0
	for i < MAX_LEVEL {
		newskl.header.forward[i] = nil
		i++
	}

	return newskl
}

func (skiplist *SkipList) Insert(key int, value string) *SkipNode {
	update := make([]*SkipNode, MAX_LEVEL)
	tmp := skiplist.header
	i := skiplist.level
	for i >= 0 {
		for tmp.forward[i] != nil && tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		update[i] = tmp
		i--
	}
	tmp = tmp.forward[0]
	if tmp != nil && tmp.key == key {
		tmp.value = value
		return tmp
	} else {
		newLvl := skiplist.RandomLevel()
		if newLvl > skiplist.level {
			i := skiplist.level + 1
			for i < newLvl {
				update[i] = skiplist.header
				i++
			}
			skiplist.level = newLvl
		}
		tmp := skiplist.MakeSkipNode(key, value)
		i := 0
		for i < newLvl {
			tmp.forward[i] = update[i].forward[i]
			update[i].forward[i] = tmp
			i++
		}
		skiplist.length++
	}

	return tmp
}

func (this *SkipList) GetLength() int {
	return this.length
}

func (this *SkipList) GetLevel() int {
	return this.level
}

func (skiplist *SkipList) Search(key int) *SkipNode {
	if skiplist.GetLength() == 0 {
		return nil
	}
	x := skiplist.header
	for i := skiplist.level; i >= 0; i-- {
		for x.forward[i] != nil && x.forward[i].key < key {
			x = x.forward[i]
		}
	}

	x = x.forward[0]
	if x != nil && x.key == key {
		return x
	}

	return nil
}

func (*SkipList) RandomLevel() int {
	level := 1
	rand.Seed(time.Now().UTC().UnixNano())
	val := rand.Float64()

	for val < 0.25 {
		level++
		rand.Seed(time.Now().UTC().UnixNano())
		val = rand.Float64()
	}

	if level < MAX_LEVEL {
		return level
	} else {
		return MAX_LEVEL
	}
}

func (skiplist *SkipList) Delete(key int) bool {
	update := make([]*SkipNode, MAX_LEVEL)
	tmp := skiplist.header

	i := skiplist.level
	for i >= 0 {
		for tmp.forward[i] != nil &&
			tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		update[i] = tmp
		i--
	}
	tmp = tmp.forward[0]
	if tmp != nil && tmp.key == key {
		i := 0
		for i < skiplist.level {
			if update[i].forward[i] != tmp {
				break
			}
			update[i].forward[i] = tmp.forward[i]
			i++
		}

		for skiplist.level > 1 &&
			len(skiplist.header.forward) > skiplist.level &&
			skiplist.header.forward[skiplist.level-1] == nil {
			skiplist.level--
		}
		skiplist.length--

		return true
	}

	return false
}

func main() {
	skiplist := NewSkipList()
	key0 := 0
	value0 := "me"

	key1 := 1
	value1 := "apple"

	key2 := 2
	value2 := "banana"

	key3 := 3
	value3 := "cat"

	key4 := 4
	value4 := "dog"

	key5 := 5
	value5 := "egg"

	key6 := 6
	value6 := "fruit"

	skiplist.Insert(key0, value0)
	skiplist.Insert(key1, value1)
	skiplist.Insert(key2, value2)
	skiplist.Insert(key3, value3)
	skiplist.Insert(key4, value4)
	skiplist.Insert(key5, value5)
	skiplist.Insert(key6, value6)

	skiplist.Delete(3)

	beginLevel := 0
	listLevel := skiplist.GetLevel()
	for beginLevel < listLevel {
		fmt.Println("level: ", beginLevel)
		x := skiplist.header.forward[beginLevel]
		for x.forward[beginLevel] != nil {
			fmt.Println(x.key)
			fmt.Println(x.value)
			x = x.forward[beginLevel]
		}
		beginLevel++
	}

	node := skiplist.Search(2)
	if node != nil {
		fmt.Println("node 2 : ", node.value)
	}

	node2 := skiplist.Search(3)
	if node2 != nil {
		fmt.Println("node 2 : ", node2.value)
	} else {
		fmt.Println("node 3 : ", node2)
	}

}
